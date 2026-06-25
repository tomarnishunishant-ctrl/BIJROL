/* ============================================
   GRAM PANCHAYAT DASHBOARD - MAIN JS
   ============================================ */

(function () {
  'use strict';

  const API_BASE = '';
  const REFRESH_INTERVAL = 30 * 60 * 1000;
  let charts = {};
  let lastUpdated = null;

  const $ = (sel) => document.querySelector(sel);
  const $$ = (sel) => document.querySelectorAll(sel);

  function updateDateTime() {
    const el = $('#go-datetime');
    if (!el) return;
    const opts = {
      weekday: 'long',
      year: 'numeric',
      month: 'long',
      day: 'numeric',
      hour: '2-digit',
      minute: '2-digit',
      second: '2-digit',
      timeZone: 'Asia/Kolkata',
    };
    el.textContent = new Intl.DateTimeFormat('en-IN', opts).format(new Date());
  }

  function setLastUpdated() {
    lastUpdated = new Date();
    const time = lastUpdated.toLocaleTimeString('en-IN');
    const header = $('#go-last-updated');
    const footer = $('#footer-sync-time');
    if (header) header.textContent = 'Last Updated: ' + time;
    if (footer) footer.textContent = time;
  }

  function showLoading() {
    const loader = $('#go-loading');
    if (loader) loader.classList.remove('hidden');
  }

  function hideLoading() {
    const loader = $('#go-loading');
    if (loader) loader.classList.add('hidden');
  }

  function scheduleRefresh() {
    setInterval(fetchDashboardData, REFRESH_INTERVAL);
  }

  async function fetchDashboardData() {
    showLoading();
    try {
      const response = await fetch(`${API_BASE}/api/dashboard`, {
        method: 'GET',
        headers: { Accept: 'application/json', 'Content-Type': 'application/json' },
      });
      if (!response.ok) throw new Error('API Error: ' + response.status);
      updateDashboard(await response.json());
    } catch (err) {
      console.warn('API fetch failed, using simulated data:', err.message);
      updateDashboard(generateMockData());
    } finally {
      setLastUpdated();
      hideLoading();
    }
  }

  function generateMockData() {
    const months = ['Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec','Jan','Feb','Mar'];
    return {
      stats: {
        totalPopulation: 11742,
        households: 1809,
        literacyRate: 63.75,
        pendingWorks: 12,
        totalSchemes: 45,
        totalAssets: 38,
      },
      populationTrend: {
        labels: months,
        male: [5800, 5820, 5835, 5840, 5850, 5860, 5870, 5880, 5890, 5900, 5910, 5920],
        female: [5800, 5810, 5825, 5830, 5840, 5850, 5860, 5870, 5880, 5890, 5900, 5910],
      },
      schemeDistribution: {
        labels: ['Health', 'Education', 'Agriculture', 'Infrastructure', 'Women Welfare', 'Employment'],
        values: [12, 15, 18, 10, 8, 7],
      },
      monthlyProgress: {
        labels: months.slice(0, 6),
        completed: [8, 12, 15, 10, 14, 18],
        ongoing: [3, 5, 4, 6, 3, 5],
      },
      works: [
        { id: 1, name: 'Road Construction Ward 3', category: 'Infrastructure', status: 'In Progress', budget: 'Rs. 5,00,000', date: '2024-01-15', progress: 65 },
        { id: 2, name: 'Drainage System Ward 1', category: 'Infrastructure', status: 'Completed', budget: 'Rs. 3,20,000', date: '2024-02-10', progress: 100 },
        { id: 3, name: 'School Building Repair', category: 'Education', status: 'Ongoing', budget: 'Rs. 8,50,000', date: '2024-03-05', progress: 40 },
        { id: 4, name: 'Street Light Installation', category: 'Infrastructure', status: 'Pending', budget: 'Rs. 2,10,000', date: '2024-03-20', progress: 10 },
        { id: 5, name: 'Community Hall Renovation', category: 'Infrastructure', status: 'In Progress', budget: 'Rs. 12,00,000', date: '2024-04-01', progress: 55 },
        { id: 6, name: 'Anganwadi Center Setup', category: 'Health', status: 'Completed', budget: 'Rs. 4,50,000', date: '2024-04-15', progress: 100 },
      ],
      assets: [
        { id: 1, name: 'Primary School Building', type: 'Building', location: 'Ward 1', value: 'Rs. 45,00,000', condition: 'Good' },
        { id: 2, name: 'Community Hall', type: 'Building', location: 'Ward 2', value: 'Rs. 30,00,000', condition: 'Good' },
        { id: 3, name: 'Water Pump Set', type: 'Equipment', location: 'Ward 3', value: 'Rs. 1,20,000', condition: 'Working' },
        { id: 4, name: 'Tractor', type: 'Vehicle', location: 'GP Office', value: 'Rs. 8,50,000', condition: 'Good' },
        { id: 5, name: 'Street Lights (LED)', type: 'Infrastructure', location: 'All Wards', value: 'Rs. 5,60,000', condition: 'Working' },
      ],
      schemes: [
        { id: 1, name: 'MGNREGA', department: 'Rural Development', beneficiaries: 450, budget: 'Rs. 65,00,000', status: 'Active' },
        { id: 2, name: 'PM Awas Yojana', department: 'Housing', beneficiaries: 120, budget: 'Rs. 40,00,000', status: 'Active' },
        { id: 3, name: 'Swachh Bharat Abhiyan', department: 'Sanitation', beneficiaries: 350, budget: 'Rs. 12,00,000', status: 'Completed' },
        { id: 4, name: 'Ujjwala Yojana', department: 'Energy', beneficiaries: 280, budget: 'Rs. 8,50,000', status: 'Active' },
        { id: 5, name: 'Mid-Day Meal', department: 'Education', beneficiaries: 520, budget: 'Rs. 18,00,000', status: 'Active' },
      ],
      payments: [
        { id: 1, recipient: 'Ramesh Kumar', work: 'Road Construction', amount: 'Rs. 1,25,000', date: '2024-03-15', status: 'Paid' },
        { id: 2, recipient: 'Sunita Devi', work: 'Drainage Cleaning', amount: 'Rs. 45,000', date: '2024-03-18', status: 'Pending' },
        { id: 3, recipient: 'Mohammad Ali', work: 'Street Light Install', amount: 'Rs. 78,000', date: '2024-03-20', status: 'Paid' },
        { id: 4, recipient: 'Priya Sharma', work: 'School Repair', amount: 'Rs. 2,10,000', date: '2024-03-22', status: 'Processing' },
      ],
    };
  }

  function updateDashboard(data) {
    updateSourceStrip(data.source || {});

    const statsMap = {
      'stat-population': data.stats.totalPopulation,
      'stat-households': data.stats.households,
      'stat-literacy': data.stats.literacyRate + '%',
      'stat-works': data.stats.pendingWorks,
      'stat-schemes': data.stats.totalSchemes,
      'stat-assets': data.stats.totalAssets,
    };

    Object.entries(statsMap).forEach(([id, value]) => {
      const el = $('#' + id);
      if (el) el.textContent = typeof value === 'number' ? value.toLocaleString('en-IN') : value;
    });

    updateChart('populationChart', 'line', {
      labels: data.populationTrend.labels,
      datasets: [
        {
          label: 'Male',
          data: data.populationTrend.male,
          borderColor: '#1857d1',
          backgroundColor: 'rgba(24,87,209,0.12)',
          fill: true,
          tension: 0.42,
        },
        {
          label: 'Female',
          data: data.populationTrend.female,
          borderColor: '#f59d2a',
          backgroundColor: 'rgba(245,157,42,0.14)',
          fill: true,
          tension: 0.42,
        },
      ],
    });

    updateChart('schemeChart', 'doughnut', {
      labels: data.schemeDistribution.labels,
      datasets: [{
        data: data.schemeDistribution.values,
        backgroundColor: ['#1857d1', '#f59d2a', '#0f9f6e', '#0f8d96', '#dc3b3b', '#6f54c9'],
        borderWidth: 3,
        borderColor: getComputedStyle(document.documentElement).getPropertyValue('--gov-card').trim() || '#fff',
      }],
    });

    updateChart('monthlyChart', 'bar', {
      labels: data.monthlyProgress.labels,
      datasets: [
        { label: 'Completed Works', data: data.monthlyProgress.completed, backgroundColor: '#0f9f6e', borderRadius: 8 },
        { label: 'Ongoing Works', data: data.monthlyProgress.ongoing, backgroundColor: '#f59d2a', borderRadius: 8 },
      ],
    });

    renderTable('worksTable', data.works || [], ['name', 'category', 'status', 'budget', 'date', 'progress'], {
      progress: (val) => `<div class="go-progress"><div class="go-progress-fill" style="width:${val}%"></div></div><small>${val}%</small>`,
      status: badgeClass,
    });

    renderSchemesAssets(data.schemes || [], data.assets || []);

    renderTable('paymentsTable', data.payments || [], ['recipient', 'work', 'amount', 'date', 'status'], {
      status: badgeClassPayment,
    });
  }

  function updateSourceStrip(source) {
    const strip = $('#go-source-strip');
    if (!strip) return;

    const status = source.status === 'live' ? 'Live' : source.status === 'cache' ? 'Cached' : 'Sample';
    const years = Array.isArray(source.planningYears) ? source.planningYears.join(', ') : 'N/A';
    const syncedAt = source.syncedAt ? new Date(source.syncedAt).toLocaleString('en-IN') : 'not synced';
    strip.textContent = `${status} eGramSwaraj data | LGD ${source.localBodyCode || '48532'} | Years ${years} | Synced ${syncedAt}`;
  }

  function badgeClass(status) {
    const map = { Active: 'success', Completed: 'info', 'In Progress': 'warning', Ongoing: 'warning', Pending: 'danger', Processing: 'warning', Paid: 'success' };
    return 'go-badge-' + (map[status] || 'info');
  }

  function badgeClassAsset(condition) {
    const map = { Good: 'success', Working: 'success', Damaged: 'danger', UnderRepair: 'warning' };
    return 'go-badge-' + (map[condition] || 'info');
  }

  function badgeClassPayment(status) {
    const map = { Paid: 'success', Pending: 'danger', Processing: 'warning' };
    return 'go-badge-' + (map[status] || 'info');
  }

  function renderTable(tableId, items, fields, formatters = {}) {
    const tbody = $('#tbody-' + tableId);
    if (!tbody) return;
    if (!items.length) {
      tbody.innerHTML = '<tr><td colspan="' + fields.length + '" style="text-align:center; padding: 30px; color: var(--gov-muted);">No data available</td></tr>';
      return;
    }
    tbody.innerHTML = items.map(item => '<tr>' + fields.map(f => {
      let val = item[f];
      if (formatters[f]) val = formatters[f](val, item);
      return `<td>${val}</td>`;
    }).join('') + '</tr>').join('');
  }

  function renderSchemesAssets(schemes, assets) {
    const grid = $('#schemes-assets-grid');
    if (!grid) return;

    const schemeCards = schemes.map((scheme) => `
      <article class="go-data-card" data-kind="scheme">
        <div class="go-data-card-header">
          <div>
            <div class="go-data-card-title">${scheme.name}</div>
            <div class="go-data-card-meta">${scheme.department}</div>
          </div>
          <span class="go-data-card-badge ${badgeClass(scheme.status)}">${scheme.status}</span>
        </div>
        <div class="go-data-card-body">
          <div><strong>${Number(scheme.beneficiaries).toLocaleString('en-IN')}</strong> beneficiaries</div>
          <div><strong>${scheme.budget}</strong> allocated budget</div>
        </div>
        <div class="go-data-card-footer"><span>Scheme</span><span>Active register</span></div>
      </article>
    `);

    const assetCards = assets.map((asset) => `
      <article class="go-data-card" data-kind="asset">
        <div class="go-data-card-header">
          <div>
            <div class="go-data-card-title">${asset.name}</div>
            <div class="go-data-card-meta">${asset.type} - ${asset.location}</div>
          </div>
          <span class="go-data-card-badge ${badgeClassAsset(asset.condition)}">${asset.condition}</span>
        </div>
        <div class="go-data-card-body">
          <div><strong>${asset.value}</strong> estimated value</div>
          <div><strong>${asset.location}</strong> location</div>
        </div>
        <div class="go-data-card-footer"><span>Asset</span><span>Inventory record</span></div>
      </article>
    `);

    grid.innerHTML = [...schemeCards, ...assetCards].join('');
  }

  function updateChart(canvasId, type, config) {
    const ctx = $('#' + canvasId);
    if (!ctx || !window.Chart) return;
    if (charts[canvasId]) charts[canvasId].destroy();

    const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
    const gridColor = isDark ? 'rgba(255,255,255,0.1)' : 'rgba(16,32,51,0.08)';
    const textColor = isDark ? '#a7b2c3' : '#68758a';

    charts[canvasId] = new Chart(ctx, {
      type,
      data: config,
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            labels: { color: textColor, font: { size: 12, weight: '700' }, padding: 16, usePointStyle: true },
          },
        },
        scales: type === 'doughnut' ? {} : {
          x: { ticks: { color: textColor }, grid: { color: gridColor } },
          y: { ticks: { color: textColor }, grid: { color: gridColor }, beginAtZero: true },
        },
      },
    });
  }

  function redrawCharts() {
    const data = generateMockData();
    Object.keys(charts).forEach(id => charts[id]?.destroy());
    charts = {};
    updateDashboard(data);
  }

  function initSearch() {
    const searchInput = $('#go-search-input');
    const filterYear = $('#go-filter-year');
    const filterCategory = $('#go-filter-category');
    const filterStatus = $('#go-filter-status');
    const resetBtn = $('#go-reset-filters');

    function applyFilters() {
      const query = (searchInput?.value || '').toLowerCase();
      const year = filterYear?.value || '';
      const category = filterCategory?.value || '';
      const status = filterStatus?.value || '';
      let visibleCount = 0;

      $$('.go-data-card').forEach(card => {
        const text = card.textContent.toLowerCase();
        const show = (!query || text.includes(query))
          && (!year || text.includes(year))
          && (!category || text.includes(category.toLowerCase()))
          && (!status || text.includes(status.toLowerCase()));
        card.style.display = show ? '' : 'none';
        if (show) visibleCount++;
      });

      const noResults = $('#go-no-results');
      if (noResults) noResults.style.display = visibleCount === 0 && query ? 'block' : 'none';
    }

    [searchInput, filterYear, filterCategory, filterStatus].forEach(el => {
      if (el) el.addEventListener('input', applyFilters);
    });

    if (resetBtn) {
      resetBtn.addEventListener('click', () => {
        if (searchInput) searchInput.value = '';
        if (filterYear) filterYear.value = '';
        if (filterCategory) filterCategory.value = '';
        if (filterStatus) filterStatus.value = '';
        applyFilters();
      });
    }
  }

  function initDarkMode() {
    const toggle = $('#go-theme-toggle');
    if (!toggle) return;

    const saved = localStorage.getItem('gp-theme') || 'light';
    document.documentElement.setAttribute('data-theme', saved);
    setThemeButton(toggle, saved);

    toggle.addEventListener('click', () => {
      const current = document.documentElement.getAttribute('data-theme');
      const next = current === 'dark' ? 'light' : 'dark';
      document.documentElement.setAttribute('data-theme', next);
      localStorage.setItem('gp-theme', next);
      setThemeButton(toggle, next);
      redrawCharts();
    });
  }

  function setThemeButton(toggle, theme) {
    toggle.innerHTML = theme === 'dark'
      ? '<span class="go-btn-symbol">LI</span><span>Light</span>'
      : '<span class="go-btn-symbol">MO</span><span>Dark</span>';
  }

  function initExport() {
    const pdfBtn = $('#go-export-pdf');
    const excelBtn = $('#go-export-excel');

    if (pdfBtn) {
      pdfBtn.addEventListener('click', () => {
        const { jsPDF } = window.jspdf || {};
        if (!jsPDF) return alert('PDF library not loaded');
        const doc = new jsPDF();
        doc.setFontSize(18);
        doc.setFont('helvetica', 'bold');
        doc.text('Bijrol Gram Panchayat Dashboard', 14, 20);
        doc.setFontSize(11);
        doc.setFont('helvetica', 'normal');
        doc.text('Generated on: ' + new Date().toLocaleString('en-IN'), 14, 28);
        doc.setFontSize(14);
        doc.setFont('helvetica', 'bold');
        doc.text('Statistics Overview', 14, 40);
        doc.setFontSize(11);
        doc.setFont('helvetica', 'normal');

        let y = 48;
        [
          ['Total Population', $('#stat-population')?.textContent || 'N/A'],
          ['Households', $('#stat-households')?.textContent || 'N/A'],
          ['Literacy Rate', $('#stat-literacy')?.textContent || 'N/A'],
          ['Pending Works', $('#stat-works')?.textContent || 'N/A'],
          ['Total Schemes', $('#stat-schemes')?.textContent || 'N/A'],
          ['Total Assets', $('#stat-assets')?.textContent || 'N/A'],
        ].forEach(([label, value]) => {
          doc.text(`${label}: ${value}`, 14, y);
          y += 8;
        });

        doc.save('bijrol-panchayat-dashboard.pdf');
      });
    }

    if (excelBtn) {
      excelBtn.addEventListener('click', () => {
        if (!window.XLSX) return alert('Excel library not loaded');
        const wb = XLSX.utils.book_new();
        const stats = [
          ['Metric', 'Value'],
          ['Total Population', $('#stat-population')?.textContent || 'N/A'],
          ['Households', $('#stat-households')?.textContent || 'N/A'],
          ['Literacy Rate', $('#stat-literacy')?.textContent || 'N/A'],
          ['Pending Works', $('#stat-works')?.textContent || 'N/A'],
          ['Total Schemes', $('#stat-schemes')?.textContent || 'N/A'],
          ['Total Assets', $('#stat-assets')?.textContent || 'N/A'],
        ];
        const ws = XLSX.utils.aoa_to_sheet(stats);
        XLSX.utils.book_append_sheet(wb, ws, 'Dashboard Stats');
        XLSX.writeFile(wb, 'bijrol-panchayat-dashboard.xlsx');
      });
    }
  }

  function initRefreshButton() {
    const refreshBtn = $('#go-refresh-btn');
    if (!refreshBtn) return;
    refreshBtn.addEventListener('click', async () => {
      refreshBtn.disabled = true;
      await fetchDashboardData();
      refreshBtn.disabled = false;
    });
  }

  function initMobileMenu() {
    const toggle = $('#go-menu-toggle');
    const links = $('#go-nav-links');
    if (!toggle || !links) return;

    toggle.addEventListener('click', () => links.classList.toggle('open'));
    links.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', () => links.classList.remove('open'));
    });
  }

  async function init() {
    updateDateTime();
    setInterval(updateDateTime, 1000);
    initDarkMode();
    initMobileMenu();
    initSearch();
    initExport();
    initRefreshButton();
    scheduleRefresh();
    await fetchDashboardData();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
