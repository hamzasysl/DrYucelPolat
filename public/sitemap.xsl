<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
                xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                xmlns:sitemap="http://www.sitemaps.org/schemas/sitemap/0.9">
<xsl:output method="html" indent="yes" encoding="UTF-8"/>

<xsl:template match="/">
<html lang="tr">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<title>XML Site Haritası — MEZ SEO</title>
<style>
    :root {
        --brand: #E63946;
        --brand-dark: #C42B37;
        --deep: #0F3D5A;
        --deep-mid: #1E5F9E;
        --deep-light: #E6EEF5;
        --leaf: #84CC16;
        --leaf-dark: #5A8E0F;
        --ink-900: #0F172A;
        --ink-700: #1F2937;
        --ink-500: #374151;
        --ink-400: #6B7280;
        --ink-300: #9CA3AF;
        --ink-200: #D1D5DB;
        --ink-100: #E5E7EB;
        --ink-50: #F7F9FB;
        --bg: #F4F6F9;
    }

    * { box-sizing: border-box; }
    html, body {
        margin: 0;
        padding: 0;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Inter', Helvetica, Arial, sans-serif;
        background: var(--bg);
        color: var(--ink-900);
        -webkit-font-smoothing: antialiased;
    }

    .container { max-width: 1140px; margin: 0 auto; padding: 32px 18px; }

    /* ============ HERO HEADER ============ */
    .hero {
        position: relative;
        background: linear-gradient(135deg, var(--deep) 0%, var(--deep-mid) 60%, #2C6FA5 100%);
        border-radius: 18px;
        padding: 32px 36px;
        color: #fff;
        overflow: hidden;
        box-shadow: 0 18px 50px -12px rgba(15, 61, 90, 0.35);
        margin-bottom: 28px;
    }
    .hero::before, .hero::after {
        content: '';
        position: absolute;
        border-radius: 50%;
        filter: blur(60px);
        pointer-events: none;
    }
    .hero::before {
        width: 360px; height: 360px;
        background: rgba(230, 57, 70, 0.25);
        top: -120px; right: -80px;
    }
    .hero::after {
        width: 280px; height: 280px;
        background: rgba(132, 204, 22, 0.22);
        bottom: -100px; left: -60px;
    }
    .hero-content { position: relative; z-index: 1; }

    .badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.14);
        backdrop-filter: blur(8px);
        padding: 6px 14px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: #fff;
        margin-bottom: 14px;
    }
    .badge-dot {
        width: 6px; height: 6px;
        border-radius: 50%;
        background: var(--leaf);
        box-shadow: 0 0 0 3px rgba(132, 204, 22, 0.35);
    }

    .hero h1 {
        font-size: 30px;
        font-weight: 800;
        line-height: 1.15;
        letter-spacing: -0.015em;
        margin: 0 0 10px 0;
        color: #fff;
    }
    .hero p {
        font-size: 14px;
        line-height: 1.65;
        color: rgba(255, 255, 255, 0.82);
        margin: 0;
        max-width: 720px;
        font-weight: 300;
    }
    .hero a {
        color: #fff;
        text-decoration: underline;
        text-decoration-color: rgba(255, 255, 255, 0.4);
        text-underline-offset: 3px;
    }
    .hero a:hover { text-decoration-color: var(--leaf); }

    .hero-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 8px 18px;
        margin-top: 18px;
        padding-top: 18px;
        border-top: 1px solid rgba(255, 255, 255, 0.12);
    }
    .hero-meta-item {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
        color: rgba(255, 255, 255, 0.78);
        font-weight: 400;
    }
    .hero-meta-item strong {
        color: #fff;
        font-weight: 700;
        margin-right: 4px;
    }
    .hero-meta-dot {
        width: 4px; height: 4px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.4);
    }

    /* ============ STATS BAR ============ */
    .stats {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 0;
        background: #fff;
        border-radius: 14px;
        border: 1px solid var(--ink-100);
        overflow: hidden;
        margin-bottom: 24px;
        box-shadow: 0 4px 18px rgba(15, 61, 90, 0.05);
    }
    .stat {
        padding: 18px 20px;
        border-right: 1px solid var(--ink-100);
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .stat:last-child { border-right: 0; }
    .stat-icon {
        width: 38px; height: 38px;
        border-radius: 10px;
        background: var(--deep-light);
        color: var(--deep-mid);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 16px;
    }
    .stat-icon.brand { background: #FDECEE; color: var(--brand); }
    .stat-icon.leaf  { background: rgba(132, 204, 22, 0.15); color: var(--leaf-dark); }
    .stat-icon.deep  { background: var(--deep-light); color: var(--deep-mid); }
    .stat-icon.ink   { background: var(--ink-50); color: var(--ink-500); }
    .stat-label {
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: var(--ink-400);
        margin: 0 0 3px 0;
        line-height: 1;
    }
    .stat-value {
        font-size: 18px;
        font-weight: 800;
        color: var(--ink-900);
        line-height: 1;
        margin: 0;
        font-variant-numeric: tabular-nums;
    }
    @media (max-width: 720px) {
        .stats { grid-template-columns: repeat(2, 1fr); }
        .stat:nth-child(2) { border-right: 0; }
        .stat:nth-child(1), .stat:nth-child(2) { border-bottom: 1px solid var(--ink-100); }
    }

    /* ============ TABLE CARD ============ */
    .card {
        background: #fff;
        border-radius: 14px;
        border: 1px solid var(--ink-100);
        overflow: hidden;
        box-shadow: 0 4px 18px rgba(15, 61, 90, 0.05);
    }
    .card-head {
        padding: 18px 24px;
        border-bottom: 1px solid var(--ink-100);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }
    .card-head h2 {
        margin: 0;
        font-size: 16px;
        font-weight: 700;
        color: var(--deep);
        letter-spacing: -0.01em;
    }
    .card-head .count {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: var(--ink-400);
        background: var(--ink-50);
        padding: 6px 12px;
        border-radius: 999px;
    }
    .card-head .count strong { color: var(--deep-mid); }

    table {
        width: 100%;
        border-collapse: collapse;
    }
    thead {
        background: linear-gradient(to bottom, #FBFCFD, #F4F6F9);
    }
    thead th {
        text-align: left;
        padding: 12px 24px;
        font-size: 10.5px;
        font-weight: 700;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: var(--ink-500);
        border-bottom: 1px solid var(--ink-100);
    }
    thead th.right { text-align: right; }
    thead th.center { text-align: center; }
    tbody tr {
        border-bottom: 1px solid var(--ink-100);
        transition: background 0.15s ease;
    }
    tbody tr:hover { background: var(--ink-50); }
    tbody tr:last-child { border-bottom: 0; }
    tbody td {
        padding: 14px 24px;
        font-size: 13.5px;
        color: var(--ink-700);
        vertical-align: middle;
    }
    tbody td.url {
        font-family: ui-monospace, 'SF Mono', Menlo, Consolas, monospace;
        font-size: 13px;
    }
    tbody td.url a {
        color: var(--deep-mid);
        text-decoration: none;
        font-weight: 500;
        word-break: break-all;
    }
    tbody td.url a:hover { color: var(--brand); text-decoration: underline; }

    .priority {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-weight: 700;
        font-variant-numeric: tabular-nums;
        color: var(--deep);
    }
    .priority-bar {
        position: relative;
        width: 60px;
        height: 6px;
        border-radius: 3px;
        background: var(--ink-100);
        overflow: hidden;
    }
    .priority-bar-fill {
        position: absolute;
        left: 0; top: 0; bottom: 0;
        background: linear-gradient(to right, var(--leaf), var(--deep-mid));
        border-radius: 3px;
    }

    .freq-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 11.5px;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 999px;
        background: var(--ink-50);
        color: var(--ink-500);
        text-transform: capitalize;
    }
    .freq-pill.weekly { background: rgba(132, 204, 22, 0.13); color: var(--leaf-dark); }
    .freq-pill.daily  { background: #FDECEE; color: var(--brand-dark); }
    .freq-pill.monthly{ background: var(--deep-light); color: var(--deep-mid); }
    .freq-pill .dot {
        width: 5px; height: 5px;
        border-radius: 50%;
        background: currentColor;
        opacity: 0.7;
    }

    .lastmod {
        color: var(--ink-500);
        font-size: 12.5px;
        font-variant-numeric: tabular-nums;
        text-align: right;
    }

    @media (max-width: 720px) {
        thead th.hide-mobile, tbody td.hide-mobile { display: none; }
        thead th, tbody td { padding: 12px 14px; }
        .hero { padding: 24px 22px; }
        .hero h1 { font-size: 22px; }
    }

    /* ============ FOOTER ============ */
    .footer {
        margin-top: 22px;
        padding: 18px 24px;
        text-align: center;
        font-size: 11.5px;
        color: var(--ink-400);
    }
    .footer .powered {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-weight: 700;
        color: var(--deep);
        text-decoration: none;
        transition: color 0.15s ease;
    }
    .footer .powered:hover { color: var(--brand); }
    .footer .powered .ico {
        color: var(--brand);
    }
    .footer .ver {
        font-size: 9.5px;
        font-weight: 700;
        background: rgba(132, 204, 22, 0.13);
        color: var(--leaf-dark);
        padding: 2px 6px;
        border-radius: 4px;
        margin-left: 4px;
    }
</style>
</head>
<body>
<div class="container">

    <!-- ============ HERO ============ -->
    <div class="hero">
        <div class="hero-content">
            <span class="badge">
                <span class="badge-dot"></span>
                MEZ SEO · XML Sitemap
            </span>
            <h1>XML Site Haritası</h1>
            <p>
                Bu sayfa Google ve Bing gibi arama motorlarının sitedeki tüm sayfaları,
                hizmetleri ve yayınları hızlıca keşfedebilmesi için hazırlandı.
                Tarayıcıda görsel sürüm için <a href="/sitemap">/sitemap</a> adresine bakabilirsin.
            </p>
            <div class="hero-meta">
                <span class="hero-meta-item">
                    <strong>URL sayısı:</strong>
                    <xsl:value-of select="count(sitemap:urlset/sitemap:url)"/>
                </span>
                <span class="hero-meta-dot"></span>
                <span class="hero-meta-item">
                    <strong>Format:</strong> XML / Sitemaps Protocol 0.9
                </span>
                <span class="hero-meta-dot"></span>
                <span class="hero-meta-item">
                    <strong>Görsel sürüm:</strong>
                    <a href="/sitemap">/sitemap</a>
                </span>
            </div>
        </div>
    </div>

    <!-- ============ STATS ============ -->
    <div class="stats">
        <div class="stat">
            <span class="stat-icon deep">📄</span>
            <div>
                <p class="stat-label">Toplam URL</p>
                <p class="stat-value"><xsl:value-of select="count(sitemap:urlset/sitemap:url)"/></p>
            </div>
        </div>
        <div class="stat">
            <span class="stat-icon brand">⭐</span>
            <div>
                <p class="stat-label">En Yüksek Öncelik</p>
                <p class="stat-value">
                    <xsl:for-each select="sitemap:urlset/sitemap:url">
                        <xsl:sort select="sitemap:priority" data-type="number" order="descending"/>
                        <xsl:if test="position() = 1"><xsl:value-of select="sitemap:priority"/></xsl:if>
                    </xsl:for-each>
                </p>
            </div>
        </div>
        <div class="stat">
            <span class="stat-icon leaf">📰</span>
            <div>
                <p class="stat-label">Haftalık Güncel</p>
                <p class="stat-value">
                    <xsl:value-of select="count(sitemap:urlset/sitemap:url[sitemap:changefreq='weekly'])"/>
                </p>
            </div>
        </div>
        <div class="stat">
            <span class="stat-icon ink">📅</span>
            <div>
                <p class="stat-label">Aylık Güncel</p>
                <p class="stat-value">
                    <xsl:value-of select="count(sitemap:urlset/sitemap:url[sitemap:changefreq='monthly'])"/>
                </p>
            </div>
        </div>
    </div>

    <!-- ============ TABLE ============ -->
    <div class="card">
        <div class="card-head">
            <h2>Site URL Listesi</h2>
            <span class="count">
                <strong><xsl:value-of select="count(sitemap:urlset/sitemap:url)"/></strong> sayfa
            </span>
        </div>
        <table>
            <thead>
                <tr>
                    <th>URL</th>
                    <th class="center hide-mobile">Öncelik</th>
                    <th class="center hide-mobile">Frekans</th>
                    <th class="right">Son Güncelleme</th>
                </tr>
            </thead>
            <tbody>
                <xsl:for-each select="sitemap:urlset/sitemap:url">
                    <xsl:sort select="sitemap:priority" data-type="number" order="descending"/>
                    <tr>
                        <td class="url">
                            <a href="{sitemap:loc}"><xsl:value-of select="sitemap:loc"/></a>
                        </td>
                        <td class="center hide-mobile">
                            <span class="priority">
                                <xsl:value-of select="sitemap:priority"/>
                                <span class="priority-bar">
                                    <span class="priority-bar-fill">
                                        <xsl:attribute name="style">
                                            width: <xsl:value-of select="sitemap:priority * 100"/>%;
                                        </xsl:attribute>
                                    </span>
                                </span>
                            </span>
                        </td>
                        <td class="center hide-mobile">
                            <span>
                                <xsl:attribute name="class">freq-pill <xsl:value-of select="sitemap:changefreq"/></xsl:attribute>
                                <span class="dot"></span>
                                <xsl:value-of select="sitemap:changefreq"/>
                            </span>
                        </td>
                        <td class="lastmod">
                            <xsl:value-of select="substring(sitemap:lastmod, 1, 10)"/>
                        </td>
                    </tr>
                </xsl:for-each>
            </tbody>
        </table>
    </div>

    <!-- ============ FOOTER ============ -->
    <div class="footer">
        <a href="https://mezbilisim.com" target="_blank" rel="noopener" class="powered">
            <span class="ico">⚡</span>
            Powered by MEZ SEO
            <span class="ver">v1.1.0</span>
        </a>
        <span style="margin: 0 8px; color: var(--ink-300);">·</span>
        <a href="https://mezbilisim.com" target="_blank" rel="noopener" style="color: var(--deep); font-weight: 600; text-decoration: none;">
            Mez Bilişim
        </a>
    </div>

</div>
</body>
</html>
</xsl:template>
</xsl:stylesheet>
