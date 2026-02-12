# pegasus-child




To change the HTML structure or PHP output of some files you must create a copy of the file in the child theme and make your changes there. 

Therefore, if you wanted an example this is what you would do:
1.) I want to change header-one.php so I go and copy the code from the file in the main theme. 
2.) Create the templates directory in the child theme if it isn't there already, then create a header-one.php in the templates directory.
3.) Then open the new empty file and paste the code into the file.
4.) Make your changes to the HTML or PHP of header-one.php, and then perform the same steps if you update the theme in the future.

## GitHub Actions Deploy (SiteGround)

This repo includes a GitHub Actions workflow to deploy the **pegasus-child** theme to SiteGround
based on the branch you push to.

**Workflow file**
- `.github/workflows/deploy-siteground.yml`

**How it triggers**
- Push to one of these branches:
  - `ulg_theme`
  - `ulg_events_theme`
  - `theloft2025_theme`
  - `mabellas_theme`
  - `saltcellar_theme`
  - `mixmarket_theme`
  - `tommygs_theme`
- The workflow runs and executes a `git pull` **inside the remote theme folder**.

**Required repo secrets**
Add these in GitHub:
- `SITEGROUND_SSH_KEY` (private key contents)
- `SITEGROUND_SSH_PORT` (typically `18765`)

**Important**
- The workflow file must exist on the branch you push to. Keep it in `master` (or `main`) and
  merge it into each deploy branch.
- Each branch maps to a single site. The workflow checks out the matching branch on the server
  and pulls only the **pegasus-child** repo.
- Your local VVV path is just where this repo lives (e.g. `www/.../pegasus-child`). The workflow
  only needs the **remote path** because it pulls directly on the server.

### Updating paths or sites
Edit the `matrix.site` entries in `deploy-siteground.yml`:
- `remote_path`: absolute path to the theme on SiteGround
- `host` / `user`: SSH connection details
- `branch`: the branch to deploy for that site

### Deploying other repos (parent theme or plugins)
If you want auto-deploys for **pegasus** (parent theme) or plugins (e.g. `pegasus-carousel`),
create a similar workflow in those repos and set:
- `remote_path` to the plugin/theme folder on SiteGround
- `branch` to the correct deploy branch for that repo

This keeps deploys scoped to **only the repo you are working in**.
