# Hart Family of Home Services — Client Portals

## Backend Scope, Data Model & Quote

**Prepared by:** Visionquest Development
**For:** Hart Family of Home Services (HFHS)
**Date:** 28‑Aug‑2026
**Rate:** $100 / hour (consistent with the completed front‑end engagement)

> This document covers **Phase 2 — the portal / application backend**. The front‑end
> engagement (15 marketing pages built into the Pegasus child theme, ~15 hrs / $1,500)
> is complete and is *not* re‑quoted here.

---

## 1. Executive summary

The four provided mockups (Customer, Employee, Founder, and Property‑Management portals)
describe a **role‑based, logged‑in field‑service operations platform** layered on top of the
existing HFHS WordPress site. In plain terms, this is a **custom web application**: customer
project tracking, online invoicing/payments, crew scheduling and time tracking, a training
library, an internal CRM/lead pipeline, approvals, messaging, and management reporting.

This is functionally comparable to commercial products like **Jobber, Housecall Pro, or
ServiceTitan**. It is a meaningful, multi‑month build — an order of magnitude larger than the
marketing site — and should be scoped, priced, and delivered in **phases**.

Five delivery options are outlined in §8. **Option E (Gravity Forms + your existing Next.js
template) is the recommended best‑value path** — see §8 and the template assessment in §8‑E.1.

| Option | Summary | Ballpark |
|---|---|---|
| **A — Full custom build (WordPress)** | All four portals, all features, built from scratch in WP | **$54k – $86k** |
| **B — Lean custom MVP (WordPress)** | Core portals; defer GPS/LMS/messaging; manual where sensible | **$22k – $34k** |
| **C — Hybrid (evaluate first)** | Integrate an existing field‑service SaaS + a light branded portal skin | **$8k – $18k custom + SaaS subscription** |
| **D — Headless: reuse VQDEV Next.js templates + WP REST API** | Clone existing Next.js portal apps, re‑skin, wire to WordPress data over REST | **$30k – $52k** (best case ~$22k–$34k) |
| **E — Gravity Forms + Next.js hybrid** ⭐ best value | GF ecosystem for forms/approvals/PDFs/payments/tables; Next.js (reused) only for the app‑like dashboards | **$26k – $46k** (best ~$20k–$30k) **+ ~$500–$900/yr licensing** |

---

## 2. What each portal contains (from the mockups)

### 2.1 Customer Portal (homeowners / clients)
- **Dashboard KPIs:** Active Projects, Open Invoices, Upcoming Visits, Lifetime Projects.
- **Quick actions:** Request New Work · Upcoming Visits (schedule) · Pay Invoices · Account Settings.
- **Active projects:** cards with status (*In Progress*, *Estimate Pending*), next visit, est. completion, job #, estimate/quote‑sent state.
- **Recent project photos:** gallery + "view full gallery".
- **Invoices & documents:** table of invoices / estimates / warranties with date, amount, status (Unpaid / Pending / Paid / Active) and actions (Pay / Review / View PDF / Download).
- **Referral program:** personal referral code + copy.

### 2.2 Employee Portal (field crew / technicians)
- **Dashboard KPIs:** Jobs Today, Hours This Week, Training Progress, Photos to Upload.
- **Time tracking:** clock in/out, start break, live shift + break timers.
- **Quick actions:** Upload Job Photos · Continue Training · Document Library · Request Time Off · Send a Message · Request Uniform/Merch · Report Vehicle Issue · Request a Truck.
- **Today's schedule:** job list with time, address, job details, directions, per‑job status.
- **Photo capture:** drag‑and‑drop upload with an upload queue + history.
- **Training library (LMS):** modules grouped by Safety / Customer Experience / Brand Standards / Technical, each Complete / In‑Progress / Not‑Started with progress %.
- **Announcements & updates:** feed from the founder/office (with read state).
- **Team messages:** inbox / threaded messages.
- **Field requests:** uniform/merch, vehicle issue, truck request forms + request history.
- **Document library:** checklists, work‑order templates, safety sheets, handbook, time‑off form (downloadable).

### 2.3 Founder Portal (owner / admin — Josh)
- **Dashboard KPIs:** Revenue MTD, Jobs in Progress, Open Estimates, Invoices Sent, Payroll Friday total.
- **Customizable quick‑action tiles:** Approve Estimates, Run Payroll, Post Announcement, Add a Lead, Send an Invoice, Assign a Job, Uniform Requests, Time‑off Requests, Vehicle Issues.
- **"Where everyone is":** live crew status board — current job, status (On Site / En Route / In Office), hours today, last update/location.
- **Approval queue:** time‑off, time corrections, estimate sign‑off, material orders — approve/decline.
- **Crew‑request queue:** uniform/merch, vehicle issues, truck requests.
- **Lead pipeline (CRM):** kanban — New/Untouched → Contacted → Estimate Sent → Scheduled → Closed (Won/Lost).
- **Active jobs:** assigned crew, progress, open‑job drill‑in.
- **Team inbox:** message threads with the crew.
- **Announcement composer:** post to All Team / role / individual.
- **Financials:** money in / money out, invoices this week, material & payroll costs, **A/R aging**.

### 2.4 Property‑Management Portal (HOA / commercial / PM clients)
- **Dashboard KPIs:** Properties Managed, Open Work Orders, Pending Approvals, YTD Spend.
- **Quick actions:** Submit Work Order · Request a Quote · Pay Invoices · Board Report.
- **My properties:** multiple property cards (address, open WOs, pending quotes) + add property.
- **Active work orders:** table (property, service, crew, status).
- **Quotes awaiting approval.**
- **Invoices & payments:** per‑property, consolidated pay.
- **Spend by property:** bar chart + CSV export.
- **Board‑ready PDF exports:** branded per‑property or portfolio activity report.

---

## 3. User roles & access model

Portals are gated by **WordPress user roles + capabilities** and role‑aware templates/routing.

| Role | Sees | Notes |
|---|---|---|
| `hfhs_customer` | Customer Portal | Homeowner; scoped to *their* projects/invoices/photos. |
| `hfhs_property_manager` | Property Portal | Manages multiple `hfhs_property` records; board reports. |
| `hfhs_employee` | Employee Portal | Field crew; scoped to assigned jobs, own time/training/requests. |
| `hfhs_manager` | Founder Portal (subset) | Office/Sales (e.g., Destiny) — leads, invoices, scheduling. |
| `hfhs_founder` | Founder Portal (full) | Owner (Josh); approvals, financials, payroll, everyone's data. |

**Access considerations (important):** every query must be **ownership‑scoped** (a customer can
only ever load their own records). This data‑isolation and capability layer is a large part of
the effort and the primary security risk area.

---

## 4. Proposed data model (Custom Post Types + CMB2 fields)

WordPress + CMB2 is a reasonable base for most of this. Notes on limits are in §4.4.
Field types below are CMB2 types (`text`, `select`, `textarea`, `file`/`file_list`,
`text_date`, `text_money`, `group` = repeatable, `user_select` = a custom post‑to‑user
relationship field).

### 4.1 Core CPTs

#### `hfhs_project` — Project / Work Order (central record)
| Field | Type | Notes |
|---|---|---|
| Customer | user_select | Owner of the project |
| Property | post_select → `hfhs_property` | Optional (PM jobs) |
| Job Number | text (auto) | e.g. JOB‑2026‑0142 |
| Status | select | Lead / Estimate Pending / Approved / Scheduled / In Progress / Complete / Closed |
| Services | taxonomy `service_type` (multi) | Reuses the 9 site services |
| Description | textarea | Scope / location / key detail |
| Address | text | Or inherit from property |
| Assigned crew | user_select (multi) | Technicians |
| Estimate amount | text_money | |
| Estimate sent / approved | text_date ×2 | Drives "Estimate Pending" state |
| Est. completion | text_date | |
| Photos | file_list | Or linked `hfhs_job_photo` records |
| Internal notes | wysiwyg | Staff‑only |

#### `hfhs_visit` — Scheduled Visit / Appointment (drives all schedules)
| Field | Type |
|---|---|
| Project | post_select → `hfhs_project` |
| Date / start time / duration | text_datetime_timestamp / text_time |
| Address + map link | text |
| Assigned crew | user_select (multi) |
| Service type | taxonomy `service_type` |
| Status | select — Scheduled / En Route / On Site / Complete |
| Job details / directions | textarea |

#### `hfhs_estimate` — Estimate / Quote
| Field | Type |
|---|---|
| Project / Customer / Property | relations |
| Line items | group (description, qty, unit price) |
| Total | text_money (computed) |
| Status | select — Draft / Sent / Pending / Approved / Declined |
| Sent / Approved date | text_date ×2 |
| PDF | file |

#### `hfhs_invoice` — Invoice
| Field | Type |
|---|---|
| Project / Customer / Property | relations |
| Line items | group |
| Amount / due date / paid date | text_money / text_date ×2 |
| Status | select — Unpaid / Pending / Paid / Overdue |
| Payment reference | text (Stripe/Toast id) |
| PDF | file |

#### `hfhs_document` — Document Library / Warranties / Handouts
| Field | Type |
|---|---|
| Type | select — Warranty / Checklist / Template / Handbook / Safety / Form |
| File | file (PDF) |
| Related project / customer | relations (optional) |
| Visibility | select (multi) — Customer / Employee / PM / All |
| Active status | select |

#### `hfhs_property` — Property (PM portal)
| Field | Type |
|---|---|
| Property Manager | user_select |
| Name / Address / Type | text |
| Access instructions | textarea |
| (derived) open WOs, pending quotes, YTD spend | computed from projects/invoices |

### 4.2 Operations CPTs

#### `hfhs_lead` — CRM pipeline card
Name · phone/email · source · service interest · **stage** (New / Contacted / Estimate Sent / Scheduled / Won / Lost) · assigned‑to (user_select) · value (text_money) · last‑contact date · notes · optional property.

#### `hfhs_request` — Field / approval request (one CPT, typed)
**Type** (select — Time Off / Uniform‑Merch / Vehicle Issue / Truck Request / Material Order / Time Correction) · Requested by (user_select) · **Status** (Pending / Approved / Declined) · Approver · dates · **type‑specific group fields** (e.g., uniform: item/size/reason; vehicle: vehicle, severity, description; time‑off: dates, coverage). Powers both the employee "Field Requests" *and* the founder "Approval Queue."

#### `hfhs_timesheet` — Time entry (time tracking + payroll)
Employee (user_select) · clock‑in / clock‑out · breaks (group) · linked visit/project · hours (computed) · date · approved (checkbox). Aggregated for "Hours This Week" and "Payroll Friday."

#### `hfhs_announcement` — Announcements & updates
Title · body (wysiwyg) · author · **audience** (All Team / role / individual) · pinned (checkbox) · date. Read‑state tracked in user meta.

#### `hfhs_training_module` — Training / LMS
Title · **category** (Safety / Customer Experience / Brand Standards / Technical) · lesson content (wysiwyg / video URL) · order · duration. **Per‑user progress** stored separately (user meta or a light `hfhs_training_progress` record: user, module, status, %, completed date).

#### `hfhs_message` (or a custom table) — Team messaging
Sender · recipients (user_select multi) · thread id · body · read‑by · related project. *Messaging is genuinely complex (threading, unread counts, real‑time) and is often better on a custom table or a purpose‑built plugin than on a CPT — see §4.4/§7.*

### 4.3 Taxonomies
- `service_type` (shared with the marketing site's 9 services).
- Optional: `job_status`, `request_type`, `training_category`, `document_type` — modeled as
  CMB2 `select` fields above for simplicity, but can be taxonomies if filtering/reporting needs grow.

### 4.4 WordPress / CMB2 caveats (scope‑affecting)
- **CMB2 has no native relationship field.** Post‑to‑post and post‑to‑user links need a helper
  (e.g., CMB2 Attached Posts, or custom `user_select` fields, or a relationships plugin). Budgeted in the Data‑Model line.
- **High‑volume / transactional data** (timesheets, messages, financial ledger) can strain the
  `wp_posts`/`wp_postmeta` model. Some entities may warrant **custom tables** for performance and
  reporting — flagged as a risk, not assumed.
- **Dashboards and money/AR‑aging math** are computed/reporting layers on top of the CPTs, not
  stored fields.

---

## 5. Third‑party integrations & infrastructure

| Integration | Purpose | Notes |
|---|---|---|
| **Payments** (Stripe or Toast) | Pay invoices in Customer/PM portals; consolidated pay | PCI handled by processor; webhooks for paid‑status |
| **PDF generation** | Invoices, estimates, warranties, **board reports** | Branded templates |
| **Email / SMS notifications** | Estimate approvals, visit reminders, request status | Transactional email + optional SMS (Twilio) |
| **Scheduling / calendar** | Visits, "today's schedule", crew assignment | Optional Google Calendar sync |
| **Crew location** ("where everyone is") | Live status/location board | GPS is heavy; MVP = manual status toggles |
| **Payroll** | "Run Payroll", Payroll‑Friday totals | Recommend **exporting hours** to a payroll provider (Gusto/QuickBooks) rather than processing payroll in‑app (tax/compliance scope) |
| **Analytics/GA** | Already covered in front‑end scope | — |

---

## 6. Cross‑cutting build modules

- **Auth & access control** — roles, capabilities, registration/onboarding, password reset, ownership‑scoping on every query.
- **Portal shell & shared UI** — responsive dashboards, KPI widgets, tables, cards, tiles (built from the mockups).
- **Notifications engine** — event → email/SMS/in‑app.
- **Reporting/analytics** — KPI aggregation, spend‑by‑property, A/R aging, financial summaries.
- **Security & QA** — role isolation testing, data‑leak prevention, cross‑device/responsive QA of every portal.
- **Documentation & handoff** — admin guides for each role.

---

## 7. Assumptions · prerequisites · out of scope

**Assumptions**
- Built on the existing WordPress/Pegasus stack unless Option C is chosen.
- HFHS provides all portal copy, document templates (invoice/estimate/warranty layouts), and the training content/videos.
- One staging environment + admin/host access + a payment‑processor account.

**Prerequisites from HFHS**
- Finalized field lists per record, invoice/estimate/board‑report layouts, training module list & media, list of quick‑action tiles to include at launch.
- Decisions on: payments processor, SMS (yes/no), GPS tracking (yes/no), payroll provider.

**Out of scope (unless separately quoted)**
- Full in‑house **payroll processing** (recommend provider integration/export).
- Native **mobile apps** (portals are responsive web).
- **Real‑time GPS fleet tracking** hardware/telematics.
- Accounting‑system (QuickBooks) two‑way sync beyond simple export.
- Data migration from any existing system (quoted after review).

---

## 8. Effort & pricing estimate ($100/hr)

### Option A — Full custom build (everything in the mockups)

| Module | Est. hours |
|---|---:|
| Foundation: roles, auth, portal shell, shared responsive UI | 40 – 56 |
| Data model: all CPTs, CMB2 fields, relationships, admin screens | 44 – 64 |
| **Customer Portal** | 44 – 64 |
| **Employee Portal** (schedule, time, photo queue, LMS, requests, msgs, docs) | 72 – 104 |
| **Founder Portal** (KPIs, crew board, approvals, CRM pipeline, financials) | 88 – 128 |
| **Property Portal** (properties, WOs, quotes, spend, board PDFs) | 44 – 64 |
| Payments integration (Stripe/Toast) | 16 – 28 |
| PDF generation (invoices/estimates/board reports) | 16 – 28 |
| Notifications (email/SMS) | 12 – 24 |
| Scheduling / calendar | 16 – 28 |
| Messaging / inbox | 24 – 44 |
| Training LMS + progress tracking | 16 – 32 |
| Time tracking + payroll summary/export | 24 – 44 |
| Reporting dashboards (KPIs, A/R aging, spend‑by‑property) | 24 – 40 |
| Crew status / location board (manual → GPS) | 12 – 32 |
| QA, security hardening, docs, PM/handoff | 48 – 80 |
| **Total** | **≈ 540 – 860 hrs** |
| **Estimated cost @ $100/hr** | **≈ $54,000 – $86,000** |

### Option B — Lean custom MVP
Core Customer + Employee + Founder + Property portals with **essentials only**: projects,
scheduling, invoices+payments, basic time tracking, requests/approvals, announcements, board
PDF. **Defer** GPS, in‑app messaging (use email), LMS (link to existing docs), advanced
financials/payroll. **≈ 220 – 340 hrs → ~$22,000 – $34,000.**

### Option C — Hybrid (worth evaluating first)
Adopt an existing field‑service platform (**Jobber / Housecall Pro / ServiceTitan**) for
scheduling, invoicing, payments, and crew management, and build a **light branded portal skin +
any gaps** on WordPress. **≈ 80 – 180 custom hrs → ~$8,000 – $18,000**, plus the SaaS monthly
subscription. *Fastest to launch, lowest custom risk; trade‑off is monthly fees and less bespoke UX.*

### Option D — Headless: reuse existing Next.js templates + WordPress REST API ⭐

**Architecture.** WordPress remains the **system of record + admin UI** — the CPTs/CMB2 from §4,
exposed through the **REST API**. The portals are **Next.js apps cloned from Visionquest's existing
template library** and re‑skinned to HFHS. A thin **Next.js API layer** handles auth, data
aggregation (KPIs, A/R aging, board reports), and third‑party calls (Stripe, PDF, SMS), talking to
WordPress over REST.

```
[Browser] → Next.js portal (Vercel)
                 │   Next.js API routes  (auth · business logic · integrations)
                 ▼
        WordPress REST API  ←→  CMB2 CPTs (projects · invoices · visits · leads · …)  ←→  wp-admin
                 │
        Stripe · PDF · Email/SMS
```

**Why this is usually the best‑value *custom* path here**
- **Large reuse savings** on portal shell, dashboards, component library, forms, and auth
  scaffolding — you already own them. Per‑portal work becomes **re‑skin + wire to endpoints +
  client‑specific logic** instead of build‑from‑scratch.
- **New work it introduces:** exposing the WP data model over REST (relationship + computed
  endpoints), a **WordPress ↔ Next.js auth bridge** (JWT / Application Passwords / NextAuth with
  role mapping), CORS/secrets, and **two deploy targets** (Vercel + the WP host).
- **Net effect:** lands **between the lean MVP (B) and full custom (A)**, while giving HFHS a bespoke,
  HFHS‑owned system (unlike the SaaS in Option C).

**The single biggest variable** is how much of the required functionality your Next.js apps already
implement (invoicing? scheduling? CRM board? time tracking? messaging?). The more they cover, the
lower the per‑portal and integration lines. → **Do a template‑fit audit (6–10 hrs)** that maps each
mockup screen to an existing component before committing to a firm number.

| Module | Est. hours |
|---|---:|
| Discovery + **template‑fit audit** + REST/auth architecture | 12 – 20 |
| WordPress data API: CPTs `show_in_rest`, custom REST fields for relations + computed values (KPIs, A/R aging, spend‑by‑property), permissions & **ownership‑scoping** | 40 – 64 |
| Auth bridge (WP users/roles ↔ Next.js; protected routes, token refresh) | 16 – 28 |
| Next.js foundation: clone templates, HFHS theming, shared config, deploy pipeline | 16 – 28 |
| **Customer Portal** — re‑skin + wire | 20 – 32 |
| **Employee Portal** — re‑skin + wire (schedule, time, uploads, requests, LMS, msgs) | 36 – 60 |
| **Founder Portal** — re‑skin + wire (approvals, CRM, financials) | 44 – 72 |
| **Property Portal** — re‑skin + wire | 20 – 36 |
| Payments (Stripe/Toast) — *reduced if already in your templates* | 8 – 24 |
| PDF generation (invoices / estimates / board reports) | 12 – 24 |
| Notifications (email / SMS) | 10 – 20 |
| Media/photo pipeline (upload queue → WP Media / object storage) | 10 – 20 |
| QA across roles · security (REST + API boundary) · DevOps/hosting · docs/handoff · PM | 44 – 72 |
| **Total** | **≈ 300 – 520 hrs** |
| **Estimated cost @ $100/hr** | **≈ $30,000 – $52,000** |

**Best case** (templates already cover invoicing, scheduling, CRM, time tracking, and messaging with
only light custom logic): **≈ 220 – 340 hrs → ~$22,000 – $34,000.**

**Phased (same shape as §9):** Phase 1 Foundation + WP REST + auth bridge + Customer Portal
(~$9k–$15k) · Phase 2 Employee Portal (~$7k–$13k) · Phase 3 Founder Portal (~$9k–$17k) ·
Phase 4 Property Portal + integrations + QA/handoff (~$6k–$12k).

**Trade‑offs to disclose:** two systems to run and secure (WordPress + Next.js/Vercel), a REST
contract to maintain, watch for N+1/latency on dashboard aggregations (cache or purpose‑built
endpoints), and ongoing hosting for both tiers.

### Option E — Gravity Forms + Next.js hybrid ⭐ (best value)

Use the **right tool per module.** A large share of these portals are *capture → route → view →
pay → PDF* flows — which the **Gravity Forms ecosystem** handles with configuration instead of
custom code. Reserve **Next.js (reused templates)** for the genuinely app‑like screens (live
dashboards, timers, kanban, charts, messaging). WordPress remains the data store (GF writes to the
same CPTs via the Advanced Post Creation add‑on, so Next.js/reporting read one clean model).

#### Capability map — who does what

| Portal feature | Best tool |
|---|---|
| Request New Work / Submit Work Order / Request a Quote / Contact | **Gravity Forms** |
| Time‑off, Uniform/Merch, Vehicle Issue, Truck Request, Material Order | **Gravity Forms** |
| Add a Lead / Send an Invoice (intake) | **Gravity Forms** → creates `hfhs_lead` / `hfhs_invoice` |
| **Approval queue** (time‑off, estimate sign‑off, corrections, material orders) | **Gravity Flow** (workflow/approvals add‑on) |
| Invoice / Estimate / Warranty / **Board report** PDFs | **Gravity PDF** (branded templates) |
| Pay Invoices (single) | **GF Stripe/Square add‑on** |
| User registration / login / role assignment | **GF User Registration add‑on** + WP roles |
| Email notifications (status, reminders) | **Gravity Forms** (built‑in) |
| Data tables/cards scoped to the logged‑in user (invoices & docs, active work orders, my requests, my properties, document library) | **GravityView** (front‑end views) + brand CSS |
| Photo/file uploads | **Gravity Forms** file fields → WP Media |
| — | — |
| Live KPI dashboards, Revenue MTD, **A/R aging**, spend‑by‑property **charts** | **Next.js** (custom) |
| **Time tracking** (clock in/out, live shift/break timers) | **Next.js** (custom) |
| **CRM kanban** pipeline (drag between stages) | **Next.js** (custom) |
| Threaded **messaging / inbox** | **Next.js** or dedicated plugin |
| **Training LMS** + progress tracking | LMS plugin or **Next.js** |
| Live crew status / "where everyone is" | **Next.js** (manual status for MVP) |
| Consolidated multi‑invoice payment | **Next.js/custom** (beyond GF single‑entry pay) |

**Effect on effort:** GF absorbs the highest‑volume, most repetitive modules (10–15 forms, the
approval engine, all PDFs, single‑invoice payments, notifications, and the simpler front‑end
tables) as **configuration**, shrinking the custom‑code surface to just the app‑like screens. It
also lets **HFHS's own office staff** create/tweak forms, notifications, and views later without a
developer — a real ongoing‑cost win.

| Module | Est. hours |
|---|---:|
| GF stack setup + add‑on config (Elite + GravityView + Flow + PDF + Stripe + User Reg) | 8 – 14 |
| Intake / request forms (10–15) — conditional logic + Advanced Post Creation → CPTs | 24 – 44 |
| Approval workflows (Gravity Flow) | 16 – 28 |
| Branded PDFs (Gravity PDF): invoice, estimate, warranty, board report | 16 – 28 |
| Payments (GF Stripe/Square): pay invoices | 10 – 20 |
| User registration / roles / login onboarding | 10 – 18 |
| GravityView front‑end tables/cards + brand CSS to match mockups | 24 – 44 |
| WordPress data model (CPTs for projects/visits/properties/leads + REST for Next.js) | 24 – 40 |
| Next.js (reused) — foundation + auth bridge + REST wiring | 24 – 44 |
| Next.js app screens: dashboards/KPIs, time tracking, CRM kanban, messaging, LMS, charts, crew board | 60 – 110 |
| Notifications (mostly GF built‑in; small custom for app events) | 4 – 12 |
| QA across roles · security · DevOps (WP+GF+Next) · docs/handoff · PM | 40 – 64 |
| **Total** | **≈ 260 – 466 hrs** |
| **Estimated cost @ $100/hr** | **≈ $26,000 – $46,000** |

**Best case** (your Next.js library already covers the dashboards/time/CRM, so those app hours drop):
**≈ 200 – 300 hrs → ~$20,000 – $30,000.**

**Recurring licensing (client cost, not dev):** Gravity Forms **Elite** (~$259/yr, includes Stripe,
User Registration, Advanced Post Creation, etc.) · **GravityView** (~$100–$250/yr) · **Gravity Flow**
(~$259/yr) · **Gravity PDF** core free (paid extensions optional). **≈ $500 – $900/yr total.**

**Caveats to disclose:** GravityView tables/cards need real CSS to match the polished mockups;
route GF submissions into CPTs (Advanced Post Creation) so Next.js/reporting read one model, not raw
GF entries; live timers, kanban drag, threaded messaging, charts, and consolidated payment stay
custom; licensing is an annual cost.

> **Recommendation:** **Option E is the best‑value path for HFHS** — GF makes ~half the platform
> config‑driven and office‑maintainable, and Next.js (your reused templates) covers only the true
> app screens. Kick off with a **discovery + fit audit (6–12 hrs, ~$600–$1,200)** that (a) maps each
> mockup screen to GF / GravityView / Gravity Flow / Next.js, and (b) checks which app modules your
> Next.js library already covers — that turns any of Options D/E into a fixed phased bid.

### E.1 — Assessed against your `nextjs-crud-app` template

*Repo reviewed 28‑Aug‑2026: `github.com/jimboobrien/nextjs-crud-app`.*

**What the template actually is.** Next.js **15.1.6** / React **19**, App Router, TypeScript,
**Bootstrap 5.3.3** (+ react‑bootstrap) + Tailwind + Sass + **FontAwesome Pro**. Auth via
**Supabase** (`@supabase/ssr`) with `login` / `register` pages, `middleware.ts` protected routes,
and an `AuthProvider`. Data via **Supabase (Postgres)** — `api/todos/route.ts` is a full
GET/POST/PUT/DELETE CRUD **already scoped per user** (`eq('user_id', user.id)`). Ships a responsive
**portal shell** (sidebar, nav, mobile nav, layout, logo) and an **admin/ vs user/** role split.
`next-auth` is also present.

**What it gives you for free — the hard, high‑risk foundations:**
- ✅ **Authentication + protected routing** (Supabase) — no fragile WordPress↔Next auth bridge needed.
- ✅ The **ownership‑scoped CRUD recipe** (page + API route + per‑user filter) — the #1 security
  concern in this quote, already proven; clone it per entity (projects, invoices, requests, leads,
  properties, timesheets…).
- ✅ Responsive **Bootstrap 5 portal shell** — visually consistent with the Pegasus marketing site.
- ✅ **Role split** scaffold (admin/user) → extend to the five HFHS roles.

**What it does NOT include (still the bulk of the build):** the domain modules themselves —
dashboards/KPIs, time‑tracking timers, CRM kanban, messaging, LMS, charts, live crew board, PDFs,
payments. The template accelerates *scaffolding* each screen; the bespoke UI/logic is still custom.
No chart/table/kanban libraries yet (add e.g. **Recharts**, a table lib, **dnd‑kit**).

**Architecture this points to (recommended).**

```
[Browser] → Next.js portal (Vercel)  ── your nextjs-crud-app template
     │        Supabase Auth (single identity) · API routes · RLS ownership scoping
     ▼
  Supabase (Postgres)  ← app + transactional data (projects, visits, timesheets,
     │                    messages, CRM, live status, invoices/estimates)
     │
WordPress + Gravity Forms  ← marketing site · public intake forms (Request a Quote,
                             Contact, Submit Work Order) · Gravity Flow approvals ·
                             Gravity PDF (invoice/estimate/board report) · GF Stripe pay ·
                             document library.  GF submissions link to a user by email
                             or POST to Supabase via webhook.
```

- **Supabase (Postgres)** becomes the app data store + identity for everything logged‑in and
  transactional. This **removes** the earlier concerns about `wp_postmeta` performance / custom
  tables (Postgres is the right tool) **and** the WordPress↔Next auth bridge (Supabase is the single
  identity). Ownership isolation is enforced with **Supabase Row‑Level Security** + the CRUD pattern
  the template already demonstrates.
- **WordPress + Gravity Forms** stays for the marketing site, public intake, approvals, PDFs,
  single‑invoice payments, and the document library (config‑driven, office‑maintainable).
- **Note the trade‑off:** app data now lives in Supabase, not wp‑admin — it's managed through the
  Founder/Admin portal (or Supabase Studio), not the WordPress dashboard. Pick one store per domain
  (e.g. keep invoices in Supabase, created via GF→webhook or in‑app) so financial reporting isn't
  split across two systems.

**Refined estimate.** The template mainly **de‑risks and speeds** the foundation (auth, shell,
secure CRUD) rather than slashing the headline, because the domain screens still dominate — but it
raises confidence because the scary parts are proven and Supabase fits the data.

| | Est. hours | Est. cost @ $100/hr |
|---|---:|---:|
| **Likely target** (Customer + Employee + Founder + Property; GF for forms/approvals/PDF/pay) | 280 – 420 | **$28,000 – $42,000** |
| **Lean MVP** (Customer + Employee + Founder essentials; defer messaging/LMS/kanban/GPS) | 220 – 280 | **$22,000 – $28,000** |

**Plus recurring (client cost, not dev):** Gravity Forms licensing ~$500–$900/yr · **Supabase**
(free tier → ~$25/mo as usage grows) · **Vercel** hosting.

**Biggest decision to lock:** commit to **Supabase as the app data store** (recommended, given the
template) rather than forcing WordPress REST for transactional data — then WordPress + Gravity Forms
handle the marketing site, intake forms, approvals, and PDFs.

**Where the template shortens specific §8‑E lines:**
- *Next.js foundation + auth bridge* → auth/shell/protected‑routes already built; **~40–60% less.**
- *Ownership‑scoped data access* → pattern proven; replicate, don't invent.
- *Per‑entity CRUD screens* → clone the `todos` recipe; faster and consistent.
- (Unchanged: the bespoke dashboards/charts/kanban/timers/messaging and the GF configuration.)

---

## 9. Recommended phased roadmap (for Option A/B)

| Phase | Delivers | Est. |
|---|---|---:|
| **0 — Discovery & architecture** | Field lists, platform decision, wireframe sign‑off | $0.8k – $1.2k |
| **1 — Foundation + Customer Portal** | Roles/auth, data model, projects, invoices+payments, photos | $12k – $18k |
| **2 — Employee Portal** | Schedule, time tracking, photo queue, requests, announcements, docs (LMS optional) | $12k – $20k |
| **3 — Founder Portal** | KPIs, crew board, approvals, CRM pipeline, financials/reporting | $15k – $25k |
| **4 — Property Portal + polish** | Properties, WOs, quotes, spend, board PDFs, notifications, QA/handoff | $10k – $18k |

Each phase is independently useful and can ship on its own.

---

## 10. Risks & considerations
- **Scope size:** this is a platform, not a page build; disciplined phasing is essential.
- **Data isolation/security:** the highest‑risk area; every query must be ownership‑scoped.
- **Performance:** timesheets/messages/financials may need custom tables at volume.
- **Payroll & payments:** compliance‑sensitive — lean on established providers.
- **Maintenance:** a portal is living software (updates, support, hosting) — a monthly
  care/retainer should be discussed separately from the build.

---

## 11. Next steps
1. Review options **A – E** and pick a direction — **Option E (§8‑E.1: Gravity Forms + your
   `nextjs-crud-app` template on Supabase) is the recommended best‑value path.**
2. **Lock the app data store:** confirm **Supabase (Postgres) as the system of record for logged‑in
   app data**, with WordPress + Gravity Forms handling the marketing site, intake forms, approvals,
   and PDFs.
3. Confirm integrations: payments processor (Stripe/Square via GF or in‑app), SMS (y/n), GPS (y/n),
   payroll provider (export vs in‑app).
4. Run the **fit audit (6–12 hrs, ~$600–$1,200)** — map each mockup screen to *GF / GravityView /
   Gravity Flow / clone‑the‑CRUD‑recipe / build‑custom* and confirm which modules the template
   already covers; this converts the range into a **fixed, phased bid**.
5. Approve the field lists in §4 (and the Supabase table equivalents) and provide document/report
   templates + training content.
6. Sign off on Phase 1 and schedule the kickoff.
