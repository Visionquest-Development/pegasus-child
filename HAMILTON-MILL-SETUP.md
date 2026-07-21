# Hamilton Mill Landing Page + $1.50 Delivery — Setup

Two things live in this theme (already done in code):

- `tpl_hamilton-mill.php` — the landing page template ("Hamilton Mill Landing").
- `functions.php` — registers the **Hamilton Mill** user role and hides the
  `$1.50` delivery method from anyone who isn't an approved Hamilton Mill resident.

The rest is one-time clicking in the WordPress/WooCommerce admin. Do these once.

---

## 1. Create the landing page (the `/hamill` URL)

1. **Pages → Add New.**
2. Title it something like `Hamilton Mill`.
3. In the right sidebar under **Page Attributes → Template**, choose
   **Hamilton Mill Landing**.
4. In the **URL / Permalink** box, set the slug to whatever memorable word you
   want for the print ad — e.g. **`hamilton-mill`** → `outlawcoffeecompany.com/hamilton-mill`,
   or **`hamill`** → `outlawcoffeecompany.com/hamill`. The slug is entirely your
   choice and can be changed anytime; no code depends on it.
5. **Publish.**

The template already contains the hero, the "how it works" steps, the signup
form, and a featured-products row. Anything you type into the normal page body
appears at the bottom of the page, so you can add extra text without editing code.

> Optional: drop a photo at `wp-content/themes/pegasus-child/images/hamilton-mill-hero.jpg`
> and it replaces the hero placeholder automatically.

---

## 2. Create the $1.50 delivery method (WooCommerce)

The delivery is a normal **Flat Rate** shipping method. The theme code hides it
from everyone except approved Hamilton Mill residents, so you can add it to your
existing US/Georgia shipping zone — it won't show to regular shoppers.

1. **WooCommerce → Settings → Shipping.**
2. Open the shipping **zone** your Hamilton Mill customers fall into (your main
   US or Georgia zone is fine — do **not** create a separate ZIP zone; the role
   controls who sees it, not geography).
3. Click **Add shipping method → Flat rate → Continue.**
4. Click the new method to edit it and set:
   - **Method title:** `Local Delivery`  ← must match exactly (see note below)
   - **Cost:** `1.50`
   - Leave everything else blank. Do **not** add per-item or percentage costs —
     a bare cost of `1.50` stays flat no matter how much they buy.
5. **Save.** Leave your existing paid shipping method(s) in the same zone so
   residents see **both** "Local Delivery – $1.50" and paid shipping and can choose.

**Naming note:** the code matches the method by its title, defined once as
`OCH_HAMILTON_DELIVERY_LABEL` (currently `Local Delivery`) near the top of the
Hamilton Mill block in `functions.php`. If you rename the method in WooCommerce,
change that constant to match.

---

## 3. Approving a resident (the day-to-day step)

1. Resident signs up via the `/hamill` page (or the normal registration page).
   Signing up alone gives them **nothing** extra yet.
2. Confirm their address is actually in Hamilton Mill (however you verify it).
3. **Users → All Users →** open that person → **Role → Hamilton Mill → Update User.**
4. Done. Next time they log in and check out, the flat **$1.50 Local Delivery**
   option appears alongside paid shipping. Everyone else never sees it.

To revoke it later, change their role back to **Customer**.

> **About the role swap:** the Hamilton Mill role is a clone of the WooCommerce
> Customer role, so switching a user to it keeps every customer ability. Past
> orders, saved addresses, downloads, and payment methods are tied to the user
> account (not the role), so nothing is lost when you change the role — and
> nothing is lost when you switch it back to Customer.

---

## How it fits together (quick reference)

| Piece | Where | Purpose |
|-------|-------|---------|
| Landing page + `/hamill` slug | WP admin (step 1) | Print-ad entry point, signup |
| `Hamilton Mill` role | `functions.php` (auto) | The "approved resident" flag |
| `$1.50 Local Delivery` flat rate | WooCommerce (step 2) | The actual delivery charge |
| Role-based visibility filter | `functions.php` (auto) | Shows delivery only to approved residents |
| Assign role to a user | WP admin (step 3) | Client approves each resident |
