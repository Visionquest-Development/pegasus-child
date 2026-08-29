# Hart Family of Home Services — Client Portals
## Product Requirements Document (PRD)

**Author:** Visionquest Development · **Version:** 1.0 · **Date:** 28‑Aug‑2026
**Status:** Draft for review
**Companion doc:** `hfhs-portals-backend-quote.md` (scope, options & pricing)

---

## 1. Purpose & vision
Deliver a **role‑based, logged‑in operations platform** for Hart Family of Home Services (HFHS)
covering four audiences — **Customers, Employees (field crew), the Founder/Admin, and Property
Managers**. The platform sits alongside the existing marketing website and gives each audience a
tailored dashboard for projects, scheduling, invoicing/payments, time tracking, training, requests,
approvals, a lead pipeline, messaging, and reporting.

Functionally comparable to Jobber / Housecall Pro / ServiceTitan, delivered as a **hybrid**:
- **WordPress + Gravity Forms** — marketing site, all intake/request **forms**, **approvals**,
  **PDF** generation, single‑invoice **payments**, and the **document library**.
- **Next.js (VQDEV `nextjs-crud-app` template) + Supabase (Postgres)** — the authenticated **app**
  screens: dashboards, KPIs, time tracking, CRM kanban, messaging, LMS, charts, live crew status.

## 2. Goals & success metrics
| Goal | Metric |
|---|---|
| Give customers self‑serve visibility | % invoices paid online; portal logins/customer/month |
| Cut office admin load | # forms/approvals handled without email/phone |
| Streamline the field crew | On‑time clock‑ins; % jobs with photos uploaded same day |
| Give the founder one operational view | Time‑to‑approve; estimate→won conversion visible in‑app |
| Win/serve property‑manager accounts | # properties managed; board reports generated |

## 3. Users & roles
| Role (Supabase) | Persona | Portal |
|---|---|---|
| `customer` | Homeowner client | Customer Portal |
| `property_manager` | HOA / commercial / PM | Property Portal |
| `employee` | Field technician / crew | Employee Portal |
| `manager` | Office & Sales (e.g., Destiny) | Founder Portal (subset) |
| `founder` | Owner (Josh) | Founder Portal (full) |

**Access rule (non‑negotiable):** every record is **ownership‑scoped** — a user can only ever load
data they own or are assigned to (Supabase Row‑Level Security + the template's per‑user CRUD pattern).

---

## 4. System responsibility split (the core architecture decision)

> **Rule of thumb:** *Capture, route, approve, pay, and generate documents* → **WordPress + Gravity
> Forms**. *Show live, aggregate, interact, and track* → **Next.js + Supabase.** Supabase (Postgres)
> is the **system of record** for logged‑in/transactional data; WordPress/GF owns marketing, intake
> forms, and PDFs. GF submissions flow to Supabase via **webhook** (or associate by user email).

```
                          ┌──────────────────────── Browser ────────────────────────┐
                          │  Marketing site (WordPress/Pegasus)   Portals (Next.js)   │
                          └───────────────┬───────────────────────────┬──────────────┘
                                          │                           │
                     WordPress + Gravity Forms                 Next.js app (Vercel)
                     • Marketing pages                         • Supabase Auth (identity)
                     • Intake/request forms                    • Dashboards, KPIs, charts
                     • Gravity Flow (approvals)                 • Time tracking, CRM kanban
                     • Gravity PDF (invoices/estimates/         • Messaging, LMS, crew board
                       warranties/board reports)                • API routes + RLS scoping
                     • GF Stripe/Square (single pay)                    │
                     • Document library / notifications                 ▼
                                          │                     Supabase (Postgres)
                                          └── webhook / REST ──▶ app + transactional data
```

### 4.1 What runs on **WordPress + Gravity Forms**
- Public marketing site (built) and the **Client/Staff Login** entry point.
- **All forms:** Request New Work, Request a Quote, Submit Work Order, Contact, Free Estimate,
  Time‑Off, Uniform/Merch, Vehicle Issue, Truck Request, Material Order, Add‑a‑Lead intake,
  Send‑an‑Invoice intake, Submit a Testimonial.
- **Approvals** via **Gravity Flow** (time‑off, estimate sign‑off, time corrections, material orders).
- **PDF generation** via **Gravity PDF** (invoice, estimate, warranty, board report).
- **Single‑invoice payments** via **GF Stripe/Square** add‑on.
- **Document library** (checklists, templates, handbook, safety sheets, forms) as downloadable files.
- **Email notifications** for form/approval events (GF built‑in).

### 4.2 What runs on **Next.js + Supabase**
- **Auth & identity** (Supabase), role‑based routing, ownership scoping (RLS).
- **All dashboards & KPI tiles** across the four portals.
- **Time tracking** (clock in/out, break, live timers), timesheet aggregation.
- **CRM lead pipeline** (kanban, drag between stages).
- **Messaging / team inbox** (threads, unread state).
- **Training LMS** modules + per‑user progress.
- **Live crew status** ("where everyone is") board.
- **Charts & aggregated reporting** (spend‑by‑property, A/R aging, financial summaries).
- **Active projects / jobs / work orders / visits** interactive views with live status.
- **Photo capture / upload queue / galleries**.
- **Referral tracking**, account settings/profile.

### 4.3 "Could go either way" — decisions
| Item | Options | Recommendation |
|---|---|---|
| Invoices/estimates data | GF entries **or** Supabase | **Supabase** is source of truth; Gravity PDF renders the document |
| Simple read‑only tables (docs, requests list) | GravityView **or** Next.js | **Next.js** for anything alongside app data; GravityView acceptable for WP‑only lists |
| Payments | GF Stripe (single) **or** in‑app Stripe (consolidated) | **GF Stripe** for MVP single pay; in‑app for consolidated multi‑invoice later |
| Announcements compose | GF **or** Next.js | **Next.js** (tied to app roles/read‑state) |

---

## 5. Global / cross‑cutting requirements
| ID | Requirement | System |
|---|---|---|
| GLB‑1 | Email/password auth with registration, login, logout, password reset | Next/Supabase |
| GLB‑2 | Five roles with capability‑gated routes and menus | Next/Supabase |
| GLB‑3 | Row‑Level Security so users only access their own/assigned records | Next/Supabase |
| GLB‑4 | Responsive, mobile‑first UI matching HFHS brand (Bootstrap 5, Pegasus palette/type) | Next/Supabase |
| GLB‑5 | Notifications: transactional email for app events; GF email for form/approval events; SMS optional | Both |
| GLB‑6 | Persistent portal shell (sidebar, top nav, mobile nav) with active‑page state | Next/Supabase |
| GLB‑7 | Single sign‑in for the portal; GF forms embedded/linked and associated to the logged‑in user | Both |
| GLB‑8 | Every record carries created/updated timestamps + created_by; key actions logged | Next/Supabase |
| GLB‑9 | HTTPS everywhere; secrets in env; least‑privilege API keys | Both |

---

## 6. Functional requirements by portal

Legend for **System** column: `WP+GF` = WordPress/Gravity Forms · `Next` = Next.js/Supabase · `Both`.

### 6.1 Customer Portal
| ID | Requirement | System |
|---|---|---|
| CUS‑1 | Dashboard KPIs: Active Projects, Open Invoices, Upcoming Visits, Lifetime Projects | Next |
| CUS‑2 | Quick action: **Request New Work** (service request form) | WP+GF |
| CUS‑3 | Quick action: **Upcoming Visits** — view scheduled visit date/time/crew | Next |
| CUS‑4 | Quick action: **Pay Invoices** (secure, single invoice) | WP+GF (Stripe) |
| CUS‑5 | Quick action: **Account Settings** (address, phone, notification prefs) | Next |
| CUS‑6 | Active Projects cards: status (In Progress / Estimate Pending), next visit, est. completion, job #, estimate/quote‑sent state | Next |
| CUS‑7 | Recent project photos gallery + "view full gallery" | Next |
| CUS‑8 | Invoices & documents table: invoice/estimate/warranty rows, date, amount, status (Unpaid/Pending/Paid/Active), actions Pay/Review/View PDF/Download | Both (data Next; PDF via Gravity PDF; pay via GF) |
| CUS‑9 | "Download everything" bulk export | Next |
| CUS‑10 | Referral program: personal code + copy | Next |

### 6.2 Employee Portal
| ID | Requirement | System |
|---|---|---|
| EMP‑1 | Dashboard KPIs: Jobs Today, Hours This Week, Training Progress, Photos to Upload | Next |
| EMP‑2 | **Time tracking**: clock in/out, start break, live shift + break timers, current job | Next |
| EMP‑3 | Today's schedule: job list w/ time, address, details, directions, per‑job status | Next |
| EMP‑4 | **Photo capture**: drag‑drop upload with queue + history | Next |
| EMP‑5 | **Training library (LMS)**: modules by category (Safety / Customer Experience / Brand Standards / Technical), Complete/In‑Progress/Not‑Started + % | Next |
| EMP‑6 | Announcements & updates feed (from founder/office) with read state | Next |
| EMP‑7 | Team messages inbox (threads) | Next |
| EMP‑8 | Field request: **Request Uniform / Merch** | WP+GF |
| EMP‑9 | Field request: **Report Vehicle Issue** | WP+GF |
| EMP‑10 | Field request: **Request a Truck** | WP+GF |
| EMP‑11 | Field request: **Request Time Off** (routes to approval) | WP+GF (Gravity Flow) |
| EMP‑12 | "My requests" history w/ status | Both (submit GF; status view Next or GravityView) |
| EMP‑13 | Document library: checklists, templates, handbook, safety, time‑off form (download) | WP+GF |
| EMP‑14 | Send a message to the team/office | Next |

### 6.3 Founder / Admin Portal
| ID | Requirement | System |
|---|---|---|
| FND‑1 | Dashboard KPIs: Revenue MTD, Jobs in Progress, Open Estimates, Invoices Sent, Payroll Friday | Next |
| FND‑2 | Customizable quick‑action tiles (Approve Estimates, Run Payroll, Post Announcement, Add a Lead, Send an Invoice, Assign a Job, Uniform/Time‑off/Vehicle queues) | Both |
| FND‑3 | **Where everyone is** — live crew status board (current job, status, hours today, last update) | Next (manual status MVP; GPS later) |
| FND‑4 | **Approval queue** — time‑off, time corrections, estimate sign‑off, material orders (approve/decline) | WP+GF (Gravity Flow), surfaced in‑app |
| FND‑5 | Crew‑request queue — uniform/merch, vehicle issues, truck requests | WP+GF (Gravity Flow) |
| FND‑6 | **Lead pipeline (CRM)** — kanban: New/Untouched → Contacted → Estimate Sent → Scheduled → Closed (Won/Lost) | Next |
| FND‑7 | Add a Lead (intake) | WP+GF → Supabase |
| FND‑8 | Active jobs list w/ assigned crew, progress, open‑job drill‑in | Next |
| FND‑9 | Team inbox — message threads w/ crew | Next |
| FND‑10 | Post an announcement (All Team / role / individual) | Next |
| FND‑11 | Send an invoice (intake) → invoice record + PDF | Both (intake GF; record Supabase; PDF Gravity PDF) |
| FND‑12 | Assign a job to crew/date | Next |
| FND‑13 | Financials: money in/out, invoices this week, material & payroll costs, **A/R aging** | Next |
| FND‑14 | **Run Payroll** — approve hours + export to payroll provider | Next (export; not in‑house processing) |

### 6.4 Property‑Management Portal
| ID | Requirement | System |
|---|---|---|
| PROP‑1 | Dashboard KPIs: Properties Managed, Open Work Orders, Pending Approvals, YTD Spend | Next |
| PROP‑2 | Quick action: **Submit Work Order** (pick property, service, photos) | WP+GF → Supabase |
| PROP‑3 | Quick action: **Request a Quote** (larger scope) | WP+GF |
| PROP‑4 | Quick action: **Pay Invoices** (per property or consolidated) | WP+GF (single) / Next (consolidated later) |
| PROP‑5 | Quick action: **Board Report** (branded PDF) | WP+GF (Gravity PDF) |
| PROP‑6 | My properties: cards (address, open WOs, pending quotes) + add property | Next |
| PROP‑7 | Active work orders table (property, service, crew, status) | Next |
| PROP‑8 | Quotes awaiting approval (review/approve) | Both |
| PROP‑9 | Invoices & payments per property | Both |
| PROP‑10 | **Spend by property** bar chart + CSV export | Next |
| PROP‑11 | Board‑ready PDF exports (per property or portfolio) | WP+GF (Gravity PDF) |

---

## 7. Data model

### 7.1 Supabase (Postgres) — system of record for app data
`profiles` (linked to auth user, role) · `projects` · `visits` · `estimates` · `estimate_line_items`
· `invoices` · `invoice_line_items` · `payments` · `requests` (typed: time‑off/uniform/vehicle/
truck/material/correction) · `leads` · `properties` · `timesheets` · `breaks` · `threads` ·
`messages` · `announcements` · `announcement_reads` · `training_modules` · `training_progress` ·
`photos` · `referrals` · `activity_log`. All tables carry `owner`/`assigned` FKs enforced by RLS.

### 7.2 WordPress / Gravity Forms
- **Gravity Forms**: one form per intake type (§4.1) + entries; **Gravity Flow** steps for approvals;
  **Gravity PDF** templates (invoice/estimate/warranty/board report).
- **WordPress**: marketing pages/CPTs (existing); optional `hfhs_document` CPT (or Media) for the
  document library; the service‑catalogue `service_type` taxonomy (shared).
- **Sync:** GF submission → **webhook** → Supabase insert/update (lead, work order, request,
  invoice). Alternatively GF Advanced Post Creation → WP CPT mirrored to Supabase. **Chosen:
  webhook → Supabase** so app dashboards read one model.

*(Detailed CMB2 field lists for the WordPress‑side records live in the companion quote doc §4; the
Supabase table columns mirror those field lists.)*

---

## 8. Integrations
| Integration | Purpose | System |
|---|---|---|
| Stripe / Square | Invoice payments | GF add‑on (single) / in‑app (consolidated) |
| Gravity PDF | Invoices, estimates, warranties, board reports | WP+GF |
| Transactional email | App events (assignments, approvals, reminders) | Next (+ GF for form emails) |
| SMS (Twilio) — optional | Visit reminders, urgent alerts | Next |
| Google Calendar — optional | Visit scheduling sync | Next |
| Payroll (Gusto/QuickBooks) | Export approved hours | Next (export/CSV) |
| GPS/telematics — optional | Live crew location | Next (deferred) |

---

## 9. Non‑functional requirements
- **Security:** RLS on every table; no cross‑user data leakage; least‑privilege keys; HTTPS; secure
  session handling; input validation on all forms/APIs.
- **Performance:** indexed Postgres queries; cached/materialized aggregates for dashboards (avoid
  N+1); paginated tables; optimized images.
- **Availability & backups:** managed hosting (Vercel + Supabase + WP host); automated DB backups.
- **Accessibility:** target WCAG 2.1 AA; keyboard‑navigable; sufficient contrast.
- **Responsive:** mobile‑first (crew uses phones in the field).
- **Browsers:** current Chrome, Safari, Firefox, Edge; iOS/Android mobile web.
- **Maintainability:** office staff can create/edit GF forms, notifications, and PDF templates
  without a developer.

---

## 10. Out of scope (unless separately quoted)
- Full in‑house payroll **processing** (compliance) — export to a provider instead.
- Native **mobile apps** (portals are responsive web).
- Real‑time **GPS/fleet** hardware/telematics.
- Two‑way **QuickBooks/accounting** sync (beyond export).
- **Data migration** from any existing system (quoted after review).

---

## 11. Phases, milestones & acceptance criteria
| Phase | Scope | Acceptance criteria |
|---|---|---|
| **P0 — Discovery & fit audit** (6–12 hrs) | Map every screen to WP+GF / Next; confirm Supabase; lock integrations; wireframe sign‑off | Signed screen‑by‑screen responsibility map + fixed phased bid |
| **P1 — Foundation + Customer Portal** | Auth/roles/RLS, Supabase schema, customer dashboard, projects, invoices+pay, photos, GF request forms | Customer can log in, see their projects/invoices, pay an invoice, request work |
| **P2 — Employee Portal** | Time tracking, schedule, photo upload, training, announcements, field requests (GF), messaging | Employee can clock in/out, see today's jobs, upload photos, submit requests |
| **P3 — Founder Portal** | KPIs, crew board, approval queue (Gravity Flow), CRM kanban, active jobs, inbox, announcements, financials, payroll export | Founder can approve requests, move leads, view financials, run payroll export |
| **P4 — Property Portal + polish** | Properties, work orders, quotes, invoices, spend chart, board PDFs, notifications, cross‑role QA/security, docs/handoff | PM can manage properties, submit WOs, approve quotes, generate board report |

Each phase ships independently and is demoed before sign‑off.

---

## 12. Open questions / decisions needed
1. **Confirm Supabase** as the app data store (recommended). ✅/❌
2. **Payments processor:** Stripe or Square? Single‑invoice only at launch, or consolidated?
3. **SMS** notifications at launch? (adds Twilio)
4. **GPS** crew tracking now (real‑time) or **manual status** for MVP?
5. **Payroll provider** for the export target (Gusto / QuickBooks / other)?
6. **Messaging** scope — simple threaded inbox vs. real‑time chat?
7. **Training LMS** — build in Next.js vs. adopt an LMS plugin?
8. Which **quick‑action tiles** are in scope for each portal at launch?
9. Confirm **invoice/estimate/board‑report layouts** and training content ownership (client‑provided).

---

## 13. Appendix — screen → system quick reference
| Portal screen | Primary system |
|---|---|
| Any **form / request / intake** | **WP + Gravity Forms** |
| Any **approval** step | **WP + Gravity Flow** |
| Any **PDF** (invoice/estimate/warranty/board report) | **WP + Gravity PDF** |
| **Single‑invoice payment** | **WP + GF Stripe/Square** |
| **Document library** downloads | **WP + Gravity Forms** |
| Any **dashboard / KPI / chart** | **Next.js + Supabase** |
| **Time tracking**, **CRM kanban**, **messaging**, **LMS**, **crew status** | **Next.js + Supabase** |
| **Projects / jobs / visits / work orders** interactive views | **Next.js + Supabase** |
| **Auth, roles, ownership scoping, account settings, referrals** | **Next.js + Supabase** |
