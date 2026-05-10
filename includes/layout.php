<?php
declare(strict_types=1);

/**
 * @param string $title Page title
 * @param string $bodyExtra Extra CSS classes on <body> (e.g. sn-body--auth)
 */
function render_header(string $title, string $bodyExtra = ''): void
{
    $bodyClass = 'sn-body' . ($bodyExtra !== '' ? ' ' . htmlspecialchars($bodyExtra, ENT_QUOTES, 'UTF-8') : '');
    echo '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<title>' . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . ' · SocialNet</title>';
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
    echo '<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&display=swap" rel="stylesheet">';
    echo '<style>
:root{
  --sn-bg:#0f1419;
  --sn-surface:#ffffff;
  --sn-surface2:#f4f6fa;
  --sn-border:#e2e8f0;
  --sn-text:#1e293b;
  --sn-muted:#64748b;
  --sn-accent:#4f46e5;
  --sn-accent-hover:#4338ca;
  --sn-accent-soft:rgba(79,70,229,.12);
  --sn-danger:#dc2626;
  --sn-danger-bg:#fef2f2;
  --sn-success:#059669;
  --sn-success-bg:#ecfdf5;
  --sn-radius:14px;
  --sn-shadow:0 4px 24px rgba(15,20,25,.08),0 1px 3px rgba(15,20,25,.06);
  --sn-shadow-lg:0 25px 50px -12px rgba(15,20,25,.15);
}
*,*::before,*::after{box-sizing:border-box}
html{font-size:16px;-webkit-font-smoothing:antialiased}
body.sn-body{
  margin:0;
  min-height:100vh;
  font-family:"DM Sans",system-ui,sans-serif;
  color:var(--sn-text);
  line-height:1.55;
  background:
    radial-gradient(1200px 600px at 80% -10%,rgba(79,70,229,.18),transparent),
    radial-gradient(800px 400px at 0% 100%,rgba(99,102,241,.12),transparent),
    linear-gradient(165deg,#eef2ff 0%,#f8fafc 45%,#f1f5f9 100%);
}
body.sn-body--auth{
  display:flex;
  flex-direction:column;
  align-items:center;
  justify-content:center;
  padding:24px 16px 48px;
}
.sn-brand{
  display:flex;
  align-items:center;
  gap:10px;
  margin-bottom:28px;
  text-decoration:none;
  color:var(--sn-text);
}
.sn-brand-mark{
  width:40px;height:40px;
  border-radius:12px;
  background:linear-gradient(135deg,var(--sn-accent),#818cf8);
  display:grid;place-items:center;
  color:#fff;font-weight:700;font-size:1.1rem;
  box-shadow:0 4px 14px rgba(79,70,229,.35);
}
.sn-brand-text{font-weight:700;font-size:1.35rem;letter-spacing:-.02em}
.sn-brand-sub{font-size:.75rem;color:var(--sn-muted);font-weight:500;margin-top:2px}

.sn-topbar{
  position:sticky;top:0;z-index:50;
  background:rgba(255,255,255,.75);
  backdrop-filter:saturate(1.2) blur(12px);
  border-bottom:1px solid var(--sn-border);
  margin:0 0 28px;
}
.sn-topbar-inner{
  max-width:960px;margin:0 auto;
  padding:14px 20px;
  display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;
}
.sn-topbar .sn-brand{margin:0}
.sn-nav{
  display:flex;flex-wrap:wrap;align-items:center;gap:6px;
}
.sn-nav a{
  padding:8px 14px;
  border-radius:999px;
  text-decoration:none;
  font-size:.9rem;font-weight:500;
  color:var(--sn-muted);
  transition:color .15s,background .15s;
}
.sn-nav a:hover{color:var(--sn-accent);background:var(--sn-accent-soft);}
.sn-nav a.sn-nav-out{color:var(--sn-danger);}
.sn-nav a.sn-nav-out:hover{background:var(--sn-danger-bg);}

.sn-main{
  max-width:960px;margin:0 auto;padding:0 20px 56px;
}
.sn-main--narrow{max-width:440px;padding-bottom:32px;}
.sn-card{
  background:var(--sn-surface);
  border-radius:var(--sn-radius);
  box-shadow:var(--sn-shadow);
  border:1px solid rgba(226,232,240,.9);
  padding:28px 32px 32px;
}
.sn-body--auth .sn-card{box-shadow:var(--sn-shadow-lg);}
.sn-card h1,.sn-card .sn-h1{
  margin:0 0 8px;
  font-size:1.65rem;font-weight:700;letter-spacing:-.03em;
}
.sn-card .sn-lead{color:var(--sn-muted);font-size:.95rem;margin:0 0 24px;}

.sn-alert{
  padding:12px 16px;border-radius:10px;margin:0 0 20px;font-size:.9rem;
}
.sn-alert--error{background:var(--sn-danger-bg);color:#991b1b;border:1px solid #fecaca;}
.sn-alert--success{background:var(--sn-success-bg);color:#047857;border:1px solid #a7f3d0;}

.sn-form label{
  display:block;font-size:.82rem;font-weight:600;color:var(--sn-muted);
  text-transform:uppercase;letter-spacing:.04em;margin-bottom:6px;
}
.sn-label-hint{font-weight:400;text-transform:none;color:var(--sn-muted);font-size:.85rem;}
.sn-form input[type=text],.sn-form input[type=password],.sn-form textarea{
  width:100%;padding:12px 14px;margin-bottom:18px;
  border:1px solid var(--sn-border);border-radius:10px;
  font:inherit;color:var(--sn-text);
  background:#fff;
  transition:border-color .15s,box-shadow .15s;
}
.sn-form input:focus,.sn-form textarea:focus{
  outline:none;border-color:var(--sn-accent);
  box-shadow:0 0 0 3px var(--sn-accent-soft);
}
.sn-form textarea{min-height:120px;resize:vertical;}

.sn-btn{
  display:inline-flex;align-items:center;justify-content:center;
  width:100%;padding:12px 20px;margin-top:4px;
  border:none;border-radius:10px;
  font:inherit;font-weight:600;font-size:.95rem;
  cursor:pointer;
  background:linear-gradient(180deg,var(--sn-accent),var(--sn-accent-hover));
  color:#fff;
  box-shadow:0 4px 14px rgba(79,70,229,.35);
  transition:transform .12s,box-shadow .12s,filter .12s;
}
.sn-btn:hover{filter:brightness(1.05);transform:translateY(-1px);}
.sn-btn:active{transform:translateY(0);}

.sn-profile-row{
  display:flex;align-items:flex-start;gap:20px;margin-bottom:28px;flex-wrap:wrap;
}
.sn-avatar{
  width:72px;height:72px;border-radius:20px;
  background:linear-gradient(135deg,var(--sn-accent),#a5b4fc);
  color:#fff;font-size:1.75rem;font-weight:700;
  display:grid;place-items:center;flex-shrink:0;
  box-shadow:var(--sn-shadow);
}
.sn-dl{margin:0;}
.sn-dl dt{font-size:.72rem;font-weight:600;color:var(--sn-muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:4px;}
.sn-dl dd{margin:0 0 14px;font-size:1.05rem;font-weight:600;}

.sn-section-title{font-size:1.15rem;font-weight:700;margin:24px 0 14px;letter-spacing:-.02em;}
.sn-user-list{list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:10px;}
.sn-user-list li{
  padding:0;border-radius:12px;
  background:var(--sn-surface2);border:1px solid var(--sn-border);
  transition:background .15s,border-color .15s;
  overflow:hidden;
}
.sn-user-list li:hover{background:#eef2ff;border-color:#c7d2fe;}
.sn-user-link{
  display:flex;flex-direction:column;gap:4px;
  padding:14px 16px;text-decoration:none;color:inherit;
}
.sn-user-link-name{font-weight:700;color:var(--sn-accent);}
.sn-user-link:hover .sn-user-link-name{text-decoration:underline;}
.sn-user-meta{font-size:.85rem;color:var(--sn-muted);}

.sn-profile-body{
  padding:20px 22px;border-radius:12px;background:var(--sn-surface2);
  border:1px solid var(--sn-border);min-height:80px;
  white-space:pre-wrap;word-break:break-word;
}
.sn-empty{color:var(--sn-muted);font-style:italic;}

.sn-about-badge{
  display:inline-block;padding:6px 12px;border-radius:8px;
  background:var(--sn-accent-soft);color:var(--sn-accent);
  font-weight:600;font-size:.9rem;
}
@media (max-width:520px){
  .sn-card{padding:22px 20px;}
  .sn-topbar-inner{padding:12px 16px;}
}
    </style></head><body class="' . $bodyClass . '">';
}

function render_menubar(): void
{
    echo '<header class="sn-topbar"><div class="sn-topbar-inner">';
    echo '<a class="sn-brand" href="/socialnet/index.php"><span class="sn-brand-mark">S</span><span><span class="sn-brand-text">SocialNet</span><span class="sn-brand-sub">Connect</span></span></a>';
    echo '<nav class="sn-nav" aria-label="Main">';
    echo '<a href="/socialnet/index.php">Home</a>';
    echo '<a href="/socialnet/setting.php">Setting</a>';
    echo '<a href="/socialnet/profile.php">Profile</a>';
    echo '<a href="/socialnet/about.php">About</a>';
    echo '<a class="sn-nav-out" href="/socialnet/signout.php">SignOut</a>';
    echo '</nav></div></header>';
}

function render_footer(): void
{
    echo '</body></html>';
}
