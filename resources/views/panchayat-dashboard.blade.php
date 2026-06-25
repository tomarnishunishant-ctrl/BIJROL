@extends('layouts.app')

@section('title', 'Panchayat Dashboard | Bijrol')

@push('styles')
<style>
    :root {
        --pd-ink: #10251c;
        --pd-muted: #65746c;
        --pd-line: rgba(16, 37, 28, .12);
        --pd-green: #1f7a4d;
        --pd-gold: #c7922c;
        --pd-blue: #315d8f;
        --pd-bg: #f5f3ec;
    }

    .panchayat-dashboard {
        min-height: 100vh;
        background:
            radial-gradient(circle at top left, rgba(31, 122, 77, .14), transparent 34rem),
            radial-gradient(circle at 85% 12%, rgba(199, 146, 44, .18), transparent 28rem),
            var(--pd-bg);
        color: var(--pd-ink);
        font-family: "Poppins", sans-serif;
        overflow: hidden;
    }

    .pd-wrap {
        width: min(1180px, calc(100% - 32px));
        margin: 0 auto;
    }

    .pd-hero {
        position: relative;
        padding: 72px 0 34px;
    }

    .pd-hero-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.25fr) minmax(300px, .75fr);
        gap: 22px;
        align-items: stretch;
    }

    .pd-hero-copy,
    .pd-live-card,
    .pd-panel,
    .pd-stat,
    .pd-work-card {
        animation: pdRise .65s ease both;
    }

    .pd-hero-copy {
        border: 1px solid var(--pd-line);
        background: rgba(255, 255, 255, .78);
        backdrop-filter: blur(18px);
        border-radius: 8px;
        padding: clamp(26px, 4vw, 46px);
        box-shadow: 0 24px 70px rgba(27, 42, 33, .12);
    }

    .pd-kicker {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: var(--pd-green);
        font-size: 12px;
        font-weight: 700;
        letter-spacing: .08em;
        text-transform: uppercase;
    }

    .pd-kicker::before {
        content: "";
        width: 34px;
        height: 2px;
        background: var(--pd-gold);
        border-radius: 99px;
    }

    .pd-hero h1 {
        margin: 18px 0 16px;
        font-size: clamp(34px, 5vw, 64px);
        line-height: 1.02;
        font-weight: 800;
        letter-spacing: 0;
    }

    .pd-hero p {
        color: var(--pd-muted);
        font-size: 16px;
        line-height: 1.75;
        margin: 0;
        max-width: 760px;
    }

    .pd-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 28px;
    }

    .pd-button {
        border: 0;
        border-radius: 999px;
        padding: 12px 18px;
        font-weight: 700;
        color: #fff;
        background: linear-gradient(135deg, #1f7a4d, #123f2c);
        box-shadow: 0 16px 34px rgba(31, 122, 77, .22);
        cursor: pointer;
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .pd-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 20px 42px rgba(31, 122, 77, .28);
    }

    .pd-button.secondary {
        color: var(--pd-ink);
        background: #fff;
        border: 1px solid var(--pd-line);
        box-shadow: none;
        text-decoration: none;
    }

    .pd-live-card {
        position: relative;
        border-radius: 8px;
        padding: 28px;
        color: #fff;
        background:
            linear-gradient(145deg, rgba(16, 37, 28, .96), rgba(25, 88, 58, .94)),
            url('{{ asset('image/bijrol.jpg.png') }}') center/cover;
        box-shadow: 0 24px 70px rgba(16, 37, 28, .2);
        overflow: hidden;
    }

    .pd-live-card::after {
        content: "";
        position: absolute;
        inset: auto -30% -42% 18%;
        height: 190px;
        background: rgba(199, 146, 44, .32);
        border-radius: 999px;
        filter: blur(10px);
    }

    .pd-live-card > * {
        position: relative;
        z-index: 1;
    }

    .pd-status {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border-radius: 999px;
        padding: 8px 12px;
        background: rgba(255, 255, 255, .15);
        font-size: 12px;
        font-weight: 700;
    }

    .pd-status-dot {
        width: 9px;
        height: 9px;
        border-radius: 50%;
        background: #73e7a4;
        box-shadow: 0 0 0 7px rgba(115, 231, 164, .14);
    }

    .pd-live-card h2 {
        margin: 34px 0 8px;
        font-size: 32px;
        font-weight: 800;
    }

    .pd-live-card p {
        color: rgba(255, 255, 255, .78);
        line-height: 1.65;
        margin: 0;
    }

    .pd-mini-meta {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-top: 28px;
    }

    .pd-mini-meta span {
        display: block;
        padding: 14px;
        border-radius: 8px;
        background: rgba(255, 255, 255, .12);
    }

    .pd-mini-meta strong {
        display: block;
        font-size: 12px;
        color: rgba(255, 255, 255, .68);
        margin-bottom: 4px;
    }

    .pd-stats {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 14px;
        margin: 8px 0 22px;
    }

    .pd-stat {
        border: 1px solid var(--pd-line);
        border-radius: 8px;
        padding: 20px;
        background: rgba(255, 255, 255, .74);
        box-shadow: 0 14px 40px rgba(27, 42, 33, .08);
    }

    .pd-stat span {
        display: block;
        color: var(--pd-muted);
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .pd-stat strong {
        display: block;
        margin-top: 8px;
        font-size: clamp(23px, 2.6vw, 34px);
        line-height: 1.05;
        font-weight: 800;
    }

    .pd-kyp {
        display: grid;
        grid-template-columns: minmax(0, .9fr) minmax(0, 1.1fr);
        gap: 18px;
        margin-bottom: 22px;
    }

    .pd-kyp-card {
        border: 1px solid var(--pd-line);
        border-radius: 8px;
        padding: 22px;
        background: rgba(255, 255, 255, .8);
        box-shadow: 0 18px 48px rgba(27, 42, 33, .08);
        animation: pdRise .65s ease both;
    }

    .pd-kyp-card h2 {
        margin: 0 0 8px;
        font-size: 21px;
        font-weight: 800;
    }

    .pd-kyp-card p {
        margin: 0;
        color: var(--pd-muted);
        font-size: 13px;
        line-height: 1.65;
    }

    .pd-path {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 8px;
        margin-top: 18px;
    }

    .pd-path span {
        border: 1px solid rgba(31, 122, 77, .18);
        border-radius: 999px;
        padding: 8px 11px;
        color: #18452f;
        background: rgba(31, 122, 77, .09);
        font-size: 12px;
        font-weight: 800;
    }

    .pd-path i {
        color: var(--pd-gold);
        font-style: normal;
        font-weight: 800;
    }

    .pd-kyp-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 10px;
    }

    .pd-kyp-grid div {
        border: 1px solid rgba(16, 37, 28, .09);
        border-radius: 8px;
        padding: 13px;
        background: #fff;
    }

    .pd-kyp-grid span {
        display: block;
        color: var(--pd-muted);
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
    }

    .pd-kyp-grid strong {
        display: block;
        margin-top: 5px;
        font-size: 15px;
    }

    .pd-section-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.45fr) minmax(320px, .55fr);
        gap: 20px;
        padding-bottom: 72px;
    }

    .pd-panel {
        border: 1px solid var(--pd-line);
        border-radius: 8px;
        background: rgba(255, 255, 255, .82);
        box-shadow: 0 20px 60px rgba(27, 42, 33, .09);
        overflow: hidden;
    }

    .pd-panel-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        padding: 20px;
        border-bottom: 1px solid var(--pd-line);
    }

    .pd-panel-head h2 {
        margin: 0;
        font-size: 20px;
        font-weight: 800;
    }

    .pd-panel-head p {
        margin: 4px 0 0;
        color: var(--pd-muted);
        font-size: 13px;
    }

    .pd-search {
        width: min(310px, 100%);
        border: 1px solid var(--pd-line);
        border-radius: 999px;
        padding: 11px 15px;
        outline: none;
        background: #fff;
        color: var(--pd-ink);
    }

    .pd-table-wrap {
        max-height: 620px;
        overflow: auto;
    }

    .pd-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 760px;
    }

    .pd-table th,
    .pd-table td {
        padding: 15px 18px;
        border-bottom: 1px solid rgba(16, 37, 28, .08);
        text-align: left;
        vertical-align: top;
    }

    .pd-table th {
        position: sticky;
        top: 0;
        z-index: 2;
        color: var(--pd-muted);
        background: #fbfaf6;
        font-size: 12px;
        text-transform: uppercase;
    }

    .pd-table td {
        color: #20382d;
        font-size: 14px;
    }

    .pd-table .amount {
        font-weight: 800;
        color: var(--pd-green);
        white-space: nowrap;
    }

    .pd-pill {
        display: inline-flex;
        border-radius: 999px;
        padding: 6px 10px;
        color: #18452f;
        background: rgba(31, 122, 77, .12);
        font-size: 12px;
        font-weight: 800;
        white-space: nowrap;
    }

    .pd-side-stack {
        display: grid;
        gap: 18px;
    }

    .pd-list {
        display: grid;
        gap: 12px;
        padding: 18px;
    }

    .pd-work-card {
        border: 1px solid rgba(16, 37, 28, .09);
        border-radius: 8px;
        padding: 15px;
        background: #fff;
    }

    .pd-work-card strong {
        display: block;
        margin-bottom: 7px;
        font-size: 14px;
        line-height: 1.45;
    }

    .pd-work-card span {
        color: var(--pd-muted);
        font-size: 12px;
    }

    .pd-loader,
    .pd-empty {
        padding: 28px;
        color: var(--pd-muted);
        text-align: center;
    }

    .pd-notice {
        margin: 0 0 22px;
        border: 1px solid rgba(49, 93, 143, .22);
        border-radius: 8px;
        padding: 14px 16px;
        color: #254868;
        background: rgba(49, 93, 143, .08);
        font-size: 13px;
        line-height: 1.6;
    }

    @keyframes pdRise {
        from {
            opacity: 0;
            transform: translateY(18px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 980px) {
        .pd-hero-grid,
        .pd-section-grid,
        .pd-kyp {
            grid-template-columns: 1fr;
        }

        .pd-stats {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 640px) {
        .pd-wrap {
            width: min(100% - 20px, 1180px);
        }

        .pd-hero {
            padding-top: 42px;
        }

        .pd-hero-copy,
        .pd-live-card,
        .pd-panel {
            border-radius: 8px;
        }

        .pd-stats,
        .pd-mini-meta,
        .pd-kyp-grid {
            grid-template-columns: 1fr;
        }

        .pd-panel-head {
            align-items: stretch;
            flex-direction: column;
        }

        .pd-search {
            width: 100%;
        }
    }
</style>
@endpush

@section('content')
<main class="panchayat-dashboard" data-dashboard-url="{{ route('api.panchayat.dashboard') }}">
    <section class="pd-hero">
        <div class="pd-wrap pd-hero-grid">
            <div class="pd-hero-copy">
                <span class="pd-kicker">Bijrol LGD 48532</span>
                <h1>Panchayat Development Dashboard</h1>
                <p>
                    Bijrol Gram Panchayat ke eGramSwaraj records se development works, sanctioned amount,
                    schemes aur recent approvals yahan automatically load hote hain. Server daily sync karta hai,
                    aur page khulne par latest cached government data dikhta hai.
                </p>
                <div class="pd-actions">
                    <button class="pd-button" type="button" data-refresh-dashboard>Refresh live data</button>
                    <a class="pd-button secondary" href="https://egramswaraj.gov.in/" target="_blank" rel="noopener">Open eGramSwaraj</a>
                </div>
            </div>

            <aside class="pd-live-card">
                <span class="pd-status"><i class="pd-status-dot"></i><span data-source-status>Loading</span></span>
                <h2 data-hero-amount>Rs. 0</h2>
                <p>Total sanctioned/approved amount from official records currently available for Bijrol.</p>
                <div class="pd-mini-meta">
                    <span><strong>Portal</strong><em data-source-portal>eGramSwaraj</em></span>
                    <span><strong>Last sync</strong><em data-source-sync>Checking...</em></span>
                </div>
            </aside>
        </div>
    </section>

    <section class="pd-wrap">
        <p class="pd-notice" data-source-message>
            Data official eGramSwaraj webservice/cache se aa raha hai. Agar government portal temporary slow ho, dashboard last successful sync ka data dikhayega.
        </p>

        <div class="pd-stats">
            <article class="pd-stat"><span>Sanctioned amount</span><strong data-stat="sanctionedAmount">Rs. 0</strong></article>
            <article class="pd-stat"><span>Planned works value</span><strong data-stat="plannedAmount">Rs. 0</strong></article>
            <article class="pd-stat"><span>Total works</span><strong data-stat="totalWorks">0</strong></article>
            <article class="pd-stat"><span>Schemes / funds</span><strong data-stat="totalSchemes">0</strong></article>
        </div>

        <div class="pd-kyp">
            <article class="pd-kyp-card">
                <h2>Know Your Panchayat Selection</h2>
                <p data-kyp-note>Official eGramSwaraj Know Your Panchayat path for Bijrol.</p>
                <div class="pd-path">
                    <span data-kyp-state>Uttar Pradesh</span><i>/</i>
                    <span data-kyp-district>Baghpat</span><i>/</i>
                    <span data-kyp-block>Baraut</span><i>/</i>
                    <span data-kyp-gp>Bijrol</span>
                </div>
                <div class="pd-actions">
                    <a class="pd-button secondary" href="https://egramswaraj.gov.in/demo/knowYourPanchayat.do" target="_blank" rel="noopener" data-kyp-link>Open official report</a>
                </div>
            </article>

            <article class="pd-kyp-card">
                <h2>Official Panchayat Profile</h2>
                <div class="pd-kyp-grid">
                    <div><span>LGD local body code</span><strong data-kyp-code>48532</strong></div>
                    <div><span>Panchayat type</span><strong data-kyp-type>Gram Panchayat</strong></div>
                    <div><span>Village</span><strong data-kyp-village>Bijrol</strong></div>
                    <div><span>KYP source status</span><strong data-kyp-status>Loading</strong></div>
                </div>
            </article>
        </div>
    </section>

    <section class="pd-wrap pd-section-grid">
        <div class="pd-panel">
            <div class="pd-panel-head">
                <div>
                    <h2>Development Works</h2>
                    <p>Road, water, sanitation, street light aur other approved activities.</p>
                </div>
                <input class="pd-search" type="search" placeholder="Search work, amount, status" data-work-search>
            </div>
            <div class="pd-table-wrap">
                <table class="pd-table">
                    <thead>
                        <tr>
                            <th>Work</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Amount</th>
                            <th>Year</th>
                        </tr>
                    </thead>
                    <tbody data-works-body>
                        <tr><td colspan="5" class="pd-loader">Loading Bijrol development data...</td></tr>
                    </tbody>
                </table>
            </div>
        </div>

        <aside class="pd-side-stack">
            <div class="pd-panel">
                <div class="pd-panel-head">
                    <div>
                        <h2>Recent Approvals</h2>
                        <p>Administrative approval and sanctioned fund entries.</p>
                    </div>
                </div>
                <div class="pd-list" data-payments-list>
                    <div class="pd-loader">Loading approvals...</div>
                </div>
            </div>

            <div class="pd-panel">
                <div class="pd-panel-head">
                    <div>
                        <h2>Assets & Counts</h2>
                        <p>Physical assets and public record totals.</p>
                    </div>
                </div>
                <div class="pd-list">
                    <div class="pd-work-card"><strong data-stat="totalAssets">0</strong><span>Total assets / progress records</span></div>
                    <div class="pd-work-card"><strong data-stat="pendingWorks">0</strong><span>Pending or not-started works</span></div>
                    <div class="pd-work-card"><strong data-stat="allocatedAmount">Rs. 0</strong><span>Resource envelope allocation</span></div>
                    <div class="pd-work-card"><strong data-stat="proposedAmount">Rs. 0</strong><span>Proposed cost in approvals</span></div>
                </div>
            </div>
        </aside>
    </section>
</main>
@endsection

@push('scripts')
<script>
(() => {
    const root = document.querySelector('.panchayat-dashboard');
    if (!root) return;

    const apiUrl = root.dataset.dashboardUrl;
    const worksBody = root.querySelector('[data-works-body]');
    const paymentsList = root.querySelector('[data-payments-list]');
    const searchInput = root.querySelector('[data-work-search]');
    const refreshButton = root.querySelector('[data-refresh-dashboard]');
    let works = [];

    const safe = (value, fallback = '-') => value === null || value === undefined || value === '' ? fallback : value;
    const esc = (value) => String(safe(value, '')).replace(/[&<>"']/g, char => ({
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    }[char]));

    const formatDate = (value) => {
        if (!value) return '-';
        const date = new Date(value);
        if (Number.isNaN(date.getTime())) return value;
        return date.toLocaleString('en-IN', { day: '2-digit', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit' });
    };

    const renderStats = (stats = {}) => {
        root.querySelectorAll('[data-stat]').forEach(node => {
            const key = node.dataset.stat;
            node.textContent = safe(stats[key], '0');
        });
        root.querySelector('[data-hero-amount]').textContent = safe(stats.sanctionedAmount || stats.plannedAmount, 'Rs. 0');
    };

    const renderWorks = () => {
        const query = (searchInput?.value || '').trim().toLowerCase();
        const filtered = works.filter(work => JSON.stringify(work).toLowerCase().includes(query)).slice(0, 120);

        if (!filtered.length) {
            worksBody.innerHTML = '<tr><td colspan="5" class="pd-empty">No matching work found.</td></tr>';
            return;
        }

        worksBody.innerHTML = filtered.map(work => `
            <tr>
                <td><strong>${esc(work.name)}</strong><br><small>Activity: ${esc(work.activityCode)}</small></td>
                <td>${esc(work.category)}</td>
                <td><span class="pd-pill">${esc(work.status)}</span></td>
                <td class="amount">${esc(work.budget)}</td>
                <td>${esc(work.date)}</td>
            </tr>
        `).join('');
    };

    const renderPayments = (payments = []) => {
        const list = payments.slice(0, 8);
        if (!list.length) {
            paymentsList.innerHTML = '<div class="pd-empty">No approval entries available right now.</div>';
            return;
        }

        paymentsList.innerHTML = list.map(payment => `
            <article class="pd-work-card">
                <strong>${esc(payment.work)} · ${esc(payment.amount)}</strong>
                <span>${esc(payment.recipient)} · ${esc(payment.date)} · ${esc(payment.status)}</span>
            </article>
        `).join('');
    };

    const renderSource = (source = {}) => {
        root.querySelector('[data-source-status]').textContent = safe(source.status, 'cache').toUpperCase();
        root.querySelector('[data-source-portal]').textContent = safe(source.portal, 'eGramSwaraj');
        root.querySelector('[data-source-sync]').textContent = formatDate(source.syncedAt);
        root.querySelector('[data-source-message]').textContent = safe(source.message, 'Showing latest available panchayat records.');
    };

    const renderKnowYourPanchayat = (profile = {}) => {
        root.querySelector('[data-kyp-state]').textContent = safe(profile.state, 'Uttar Pradesh');
        root.querySelector('[data-kyp-district]').textContent = safe(profile.district, 'Baghpat');
        root.querySelector('[data-kyp-block]').textContent = safe(profile.block, 'Baraut');
        root.querySelector('[data-kyp-gp]').textContent = safe(profile.gramPanchayat, 'Bijrol');
        root.querySelector('[data-kyp-code]').textContent = safe(profile.localBodyCode, '48532');
        root.querySelector('[data-kyp-type]').textContent = safe(profile.panchayatType, 'Gram Panchayat');
        root.querySelector('[data-kyp-village]').textContent = safe(profile.village, 'Bijrol');
        root.querySelector('[data-kyp-status]').textContent = safe(profile.status, 'cache').toUpperCase();
        root.querySelector('[data-kyp-note]').textContent = safe(profile.note, 'Official Know Your Panchayat data is shown from eGramSwaraj public records.');
        const link = root.querySelector('[data-kyp-link]');
        if (link && profile.officialUrl) link.href = profile.officialUrl;
    };

    const loadDashboard = async (force = false) => {
        try {
            if (refreshButton) {
                refreshButton.disabled = true;
                refreshButton.textContent = force ? 'Refreshing...' : 'Loading...';
            }
            const response = await fetch(`${apiUrl}${force ? '?refresh=1' : ''}`, { headers: { Accept: 'application/json' } });
            if (!response.ok) throw new Error('Dashboard API failed');
            const data = await response.json();
            works = Array.isArray(data.works) ? data.works : [];
            renderSource(data.source);
            renderStats(data.stats);
            renderKnowYourPanchayat(data.knowYourPanchayat);
            renderWorks();
            renderPayments(data.payments || []);
        } catch (error) {
            worksBody.innerHTML = '<tr><td colspan="5" class="pd-empty">Dashboard data abhi load nahi ho paya. Thodi der baad refresh karein.</td></tr>';
            paymentsList.innerHTML = '<div class="pd-empty">Approvals unavailable.</div>';
            root.querySelector('[data-source-message]').textContent = error.message;
        } finally {
            if (refreshButton) {
                refreshButton.disabled = false;
                refreshButton.textContent = 'Refresh live data';
            }
        }
    };

    searchInput?.addEventListener('input', renderWorks);
    refreshButton?.addEventListener('click', () => loadDashboard(true));
    loadDashboard(false);
    window.setInterval(() => loadDashboard(false), 300000);
})();
</script>
@endpush
