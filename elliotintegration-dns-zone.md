# DNS Zone File Lookup — elliotintegration.com

**Lookup date:** 2026-10-23
**Authoritative nameservers:** A2 Hosting (`ns1`–`ns4.a2hosting.com`)
**Primary IP:** `70.32.23.120`

---

## SOA (Start of Authority)

| Field | Value |
|-------|-------|
| Primary NS | `ns1.a2hosting.com.` |
| Responsible party | `root.mi3-ss106.a2hosting.com.` |
| Serial | `2026092301` |
| Refresh | `3600` |
| Retry | `1800` |
| Expire | `1209600` |
| Minimum TTL | `86400` |

## NS (Nameservers)

| TTL | Target |
|-----|--------|
| 86400 | `ns1.a2hosting.com.` |
| 86400 | `ns2.a2hosting.com.` |
| 86400 | `ns3.a2hosting.com.` |
| 86400 | `ns4.a2hosting.com.` |

## A / CNAME Records

| Host | TTL | Type | Value |
|------|-----|------|-------|
| `elliotintegration.com.` | 14400 | A | `70.32.23.120` |
| `www` | 14400 | CNAME | `elliotintegration.com.` |
| `mail` | 14400 | CNAME | `elliotintegration.com.` |
| `ftp` | 14400 | CNAME | `elliotintegration.com.` |
| `cpanel` | 14400 | A | `70.32.23.120` |
| `webmail` | 14400 | A | `70.32.23.120` |

*No AAAA (IPv6) records found.*

## MX (Mail Exchange)

| Priority | TTL | Target |
|----------|-----|--------|
| 0 | 14400 | `elliotintegration.com.` |

## TXT Records

**SPF** (`elliotintegration.com.`, TTL 14400):
```
v=spf1 ip4:70.32.23.120 include:spf.a2hosting.com +ip4:70.32.23.120 +ip4:75.98.175.105 +include:spf.supercp.com ~all
```

**DKIM** (`default._domainkey.elliotintegration.com.`, TTL 14400):
```
v=DKIM1; k=rsa; p=MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA5ERuQ5QNBIXLdJdWN1Qo3nkV9xT6PP3soXNf8n49ATeVS5j7WnFRpVP6ocGf6qN/Ib6rdfsVslpgZ4syU4vu2z3W4oPTxKFQ/JTUVDBuFIq4ZlWan/hxyP/fQ+flL7++16XUdB1T+8xFVjgEOG2TiOJtF/Rr8beHYh1BgAXCyYA3g8O6xR9tZiBRTKKoi/klUlTdp2JE8RxRTy+KzlN6Qrkom6PBjb4HU1o1G6ZnbhONUtxIof/fyu2qhPxt0ueTWYOSj/OdoP+D5Y3d1g+FklYLSQwG1Y/th7KGLWMDyQpidaUqlY5oSdRv1/gNpHesKZuZ6fUNIurJnx8AoS2XPwIDAQAB;
```

## Records Not Present

The following queries returned no records:

- **AAAA** (IPv6)
- **CAA** (Certificate Authority Authorization)
- **SRV**
- **DMARC** (`_dmarc.elliotintegration.com` — no policy published)
- **autodiscover** CNAME

---

## Reconstructed Zone File (BIND format)

```zone
$ORIGIN elliotintegration.com.
$TTL 86400

@       IN  SOA ns1.a2hosting.com. root.mi3-ss106.a2hosting.com. (
                2026092301  ; serial
                3600        ; refresh
                1800        ; retry
                1209600     ; expire
                86400 )     ; minimum

@       86400   IN  NS      ns1.a2hosting.com.
@       86400   IN  NS      ns2.a2hosting.com.
@       86400   IN  NS      ns3.a2hosting.com.
@       86400   IN  NS      ns4.a2hosting.com.

@       14400   IN  A       70.32.23.120
@       14400   IN  MX      0 elliotintegration.com.

www     14400   IN  CNAME   elliotintegration.com.
mail    14400   IN  CNAME   elliotintegration.com.
ftp     14400   IN  CNAME   elliotintegration.com.
cpanel  14400   IN  A       70.32.23.120
webmail 14400   IN  A       70.32.23.120

@       14400   IN  TXT     "v=spf1 ip4:70.32.23.120 include:spf.a2hosting.com +ip4:70.32.23.120 +ip4:75.98.175.105 +include:spf.supercp.com ~all"

default._domainkey 14400 IN TXT ( "v=DKIM1; k=rsa; "
    "p=MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA5ERuQ5QNBIXLdJdWN1Qo3nkV9xT6PP3soXNf8n49ATeVS5j7WnFRpVP6ocGf6qN/Ib6rdfsVslpgZ4syU4vu2z3W4oPTxKFQ/JTUVDBuFIq4ZlWan/hxyP/fQ+flL7++16XUdB1T+8xFVjgEOG2TiOJtF/Rr8beHYh1BgAXCyYA3g8O6xR9tZiBRTKKoi/klU"
    "lTdp2JE8RxRTy+KzlN6Qrkom6PBjb4HU1o1G6ZnbhONUtxIof/fyu2qhPxt0ueTWYOSj/OdoP+D5Y3d1g+FklYLSQwG1Y/th7KGLWMDyQpidaUqlY5oSdRv1/gNpHesKZuZ6fUNIurJnx8AoS2XPwIDAQAB;" )
```

> **Note:** This zone is served by A2 Hosting's nameservers. The reconstruction above is assembled from external `dig` queries and reflects publicly resolvable records only — it may not include every record in the authoritative zone (e.g., additional subdomains or internal records not queried).
