# CLAUDE.md — Pegasus Child (Salt Cellar / ULG restaurant sites)

Guidance for working in this theme and deploying the Toast menu + shared plugins.

## Toast "Refresh menu cache" admin-bar button

The JSON-powered food menu (Toast POS) is cached in WordPress transients. The
manual cache-clear button in the admin bar is built in **two layers**:

1. **Plugin `vqdev-toast`** owns the admin-bar button
   (`includes/class-toast-admin-bar.php`, class `Toast_Admin_Bar`). On click it
   verifies a nonce, fires `do_action( 'vqdev_toast_flush_cache' )`, redirects
   clean, and shows a dismissible confirmation toast. It is a **shared repo**
   used by every restaurant site (see below), so the button code is identical
   everywhere and is updated by `git pull`, not by editing per site.

2. **This theme** (`functions.php`) hooks that action and deletes *its own*
   menu transients — the theme is what caches the menu, so it must clear it:

   ```php
   add_action( 'vqdev_toast_flush_cache', function () {
       delete_transient( 'vqdev_toast_menu_data' );
       delete_transient( 'vqdev_toast_metadata_checked' );   // theloft: vqdev_toast_menu_meta_check
       delete_transient( 'vqdev_toast_oos_guids' );
   } );
   ```

   Transient keys differ per site — verify against the theme's own
   `set_transient(...)` / `$cache_key` calls before copying the hook.
   The Loft uses `vqdev_toast_menu_meta_check` instead of
   `vqdev_toast_metadata_checked`.

To add the button to a new restaurant site: `git pull` the `vqdev-toast` plugin
(the button + flush action come with it) and add the theme hook above with that
site's transient keys.

## Deploying to production (SiteGround)

### Themes deploy automatically on push (GitHub Actions)

**Themes** (this `pegasus-child` theme, etc.) do **not** need the sync scripts.
Pushing to the theme's tracked branch (e.g. `theloft2025_theme`) triggers a
GitHub Actions workflow that `git pull`s the theme on the live SiteGround server
automatically. So for a theme change the full deploy is just:

```bash
git add … && git commit -m "…" && git push
```

Wait for the Actions run to finish, then verify on the live site. Do **not** run
`deploy.sh … child` — that step is handled in the cloud now.

### Plugins deploy via the sync scripts (manual)

The sync tooling is only needed for **plugins**. It lives in
**`/home/jim/Projects/vagrant-local/sync/`**:

- `deploy.sh` — the deploy script (reads **`sites.json`**, which holds SSH creds
  + per-site theme branches + plugin lists). `repos.json` is a parallel, leaner
  copy without SSH info; **`sites.json` is what `deploy.sh` actually uses.**
- `.env` — `SSH_KEY_PATH` (`~/.ssh/ulg_siteground`), `SSH_PASSPHRASE`, `SSH_PORT`.
  Not committed.

### One-time prerequisite each session: load the SSH key into the agent

The deploy key is passphrase-protected. `deploy.sh` runs `ssh -i` with no
askpass, so in a fresh shell the `git pull` step fails with
`Permission denied (publickey)` / `ssh_askpass ... No such file`. Fix by adding
the key to the running ssh-agent once (interactive terminal):

```bash
ssh-add ~/.ssh/ulg_siteground     # paste passphrase from sync/.env when prompted
ssh-add -l                        # confirm SHA256:Z+Kr83Dt... is listed
```

After that, all `deploy.sh` pulls run non-interactively for the rest of the session.

### Common deploy commands

Run from `sync/`:

```bash
./deploy.sh list                              # all configured sites
./deploy.sh pull <site> plugin vqdev-toast    # one plugin, one site
./deploy.sh pull <site> plugins               # all that site's plugins
```

`deploy.sh` can still pull themes (`child`, `all`), but that's no longer needed —
themes auto-deploy on push (see above). Use it for plugins.

### Pull one plugin across every site that has it (fleet-wide)

`deploy.sh` has no "all sites" mode — loop over the JSON with `jq`:

```bash
cd /home/jim/Projects/vagrant-local/sync
PLUGIN=vqdev-toast
for site in $(jq -r --arg p "$PLUGIN" \
    '.sites | to_entries[] | select(.value.plugins | index($p)) | .key' sites.json); do
  echo "=== $site ==="
  ./deploy.sh pull "$site" plugin "$PLUGIN"
done
```

### Pull ALL maintained plugins on ALL sites

```bash
cd /home/jim/Projects/vagrant-local/sync
for site in $(jq -r '.sites | keys[]' sites.json); do
  echo "=== $site ==="
  ./deploy.sh pull "$site" plugins
done
```

### Notes / gotchas

- A pull only works if the plugin/theme folder on the server is a **git clone**.
  If not, `deploy.sh` reports "not a git repository" and skips it — clone it on
  the server first. (As of last deploy, **sugarpeddler** is listed with
  `vqdev-toast` in the JSON but the plugin is **not installed** on its live
  server, so it is skipped.)
- Sites with `vqdev-toast`: saltcellar, theloft, mabellas, mixmarket, tommygs
  (+ sugarpeddler in JSON only). `ulg` and `ulg-events` do **not** have a Toast
  JSON menu — skip them for Toast work.
- Failures are logged with timestamps to `sync/deploy.log`.
