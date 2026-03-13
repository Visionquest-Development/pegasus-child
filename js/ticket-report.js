(function ($) {
  'use strict';

  var $eventSelect = $('#event-select');
  var $loadBtn = $('#load-event-btn');
  var $eventResults = $('#event-results');
  var $eventSummary = $('#event-summary');
  var $customerSearch = $('#customer-search');
  var $searchBtn = $('#search-customer-btn');
  var $customerResults = $('#customer-results');

  // ── Sortable table headers ──
  // Click any <th> with data-sort-col to sort its table's <tbody> rows.
  $(document).on('click', 'th[data-sort-col]', function () {
    var $th = $(this);
    var $table = $th.closest('table');
    var colIdx = $th.data('sort-col');
    var dir = $th.data('sort-dir') === 'asc' ? 'desc' : 'asc';

    // Reset all headers in this table, then set active
    $table.find('th[data-sort-col]').removeData('sort-dir').removeClass('tr-sort-asc tr-sort-desc');
    $th.data('sort-dir', dir).addClass(dir === 'asc' ? 'tr-sort-asc' : 'tr-sort-desc');

    var $tbody = $table.find('tbody');
    var rows = $tbody.find('tr').get();

    rows.sort(function (a, b) {
      var aText = $(a).children('td').eq(colIdx).text().trim().toLowerCase();
      var bText = $(b).children('td').eq(colIdx).text().trim().toLowerCase();

      // Try numeric comparison (strip $ and #)
      var aNum = parseFloat(aText.replace(/[$#,]/g, ''));
      var bNum = parseFloat(bText.replace(/[$#,]/g, ''));

      if (!isNaN(aNum) && !isNaN(bNum)) {
        return dir === 'asc' ? aNum - bNum : bNum - aNum;
      }
      // Fall back to string comparison
      if (aText < bText) return dir === 'asc' ? -1 : 1;
      if (aText > bText) return dir === 'asc' ? 1 : -1;
      return 0;
    });

    $.each(rows, function (i, row) {
      $tbody.append(row);
    });
  });

  // Load events into dropdown on page load
  $.post(ticketReport.ajax_url, {
    action: 'tr_get_events',
    nonce: ticketReport.nonce
  }, function (res) {
    if (res.success && res.data.length) {
      $.each(res.data, function (i, ev) {
        $eventSelect.append(
          $('<option>', { value: ev.product_id, text: ev.event_name + ' (' + ev.ticket_count + ' tickets)' })
        );
      });
    } else {
      $eventSelect.append('<option value="" disabled>No events found</option>');
    }
  });

  $eventSelect.on('change', function () {
    $loadBtn.prop('disabled', !this.value);
  });

  // Build sortable header
  function sortTh(label, colIdx) {
    return '<th data-sort-col="' + colIdx + '">' + label + '</th>';
  }

  // Build check-in buttons for an array of tickets within an order
  function checkinBtns(tickets) {
    var html = '<div class="tr-checkin-group">';
    $.each(tickets, function (i, t) {
      var isCheckedIn = (t.status === 'Checked In');
      var btnClass = isCheckedIn ? 'btn-success' : 'btn-outline-secondary';
      var label = isCheckedIn ? 'Checked In' : 'Check In';
      html += '<button class="btn btn-sm ' + btnClass + ' tr-checkin-btn me-1 mb-1" ' +
        'data-ticket-id="' + t.ticket_id + '" data-status="' + escHtml(t.status) + '" ' +
        'title="Ticket #' + t.ticket_id + '">' +
        label + '</button>';
    });
    html += '</div>';
    return html;
  }

  // Handle check-in toggle
  $(document).on('click', '.tr-checkin-btn', function () {
    var $btn = $(this);
    var ticketId = $btn.data('ticket-id');

    $btn.prop('disabled', true).text('...');

    $.post(ticketReport.ajax_url, {
      action: 'tr_toggle_checkin',
      nonce: ticketReport.nonce,
      ticket_id: ticketId
    }, function (res) {
      if (!res.success) {
        alert('Check-in failed.');
        $btn.prop('disabled', false);
        return;
      }

      var newStatus = res.data.new_status;
      var isCheckedIn = (newStatus === 'Checked In');

      $btn
        .data('status', newStatus)
        .prop('disabled', false)
        .text(isCheckedIn ? 'Checked In' : 'Check In')
        .removeClass('btn-success btn-outline-secondary')
        .addClass(isCheckedIn ? 'btn-success' : 'btn-outline-secondary');
    });
  });

  // Load tickets for selected event
  $loadBtn.on('click', function () {
    var productId = $eventSelect.val();
    if (!productId) return;

    $eventResults.html('<p class="text-muted">Loading...</p>');
    $eventSummary.addClass('d-none');

    $.post(ticketReport.ajax_url, {
      action: 'tr_get_event_tickets',
      nonce: ticketReport.nonce,
      product_id: productId
    }, function (res) {
      if (!res.success) {
        $eventResults.html('<p class="text-danger">Error loading tickets.</p>');
        return;
      }

      var data = res.data;

      $eventSummary
        .removeClass('d-none')
        .html(
          '<strong>' + escHtml(data.event_name) + '</strong> &mdash; ' +
          data.total_orders + ' order(s), ' +
          data.total_tickets + ' ticket(s), ' +
          'Total Revenue: $' + data.total_revenue
        );

      if (!data.orders.length) {
        $eventResults.html('<p>No tickets found for this event.</p>');
        return;
      }

      var html = '<div class="table-responsive"><table class="table table-striped table-hover">' +
        '<thead><tr>' +
        sortTh('Order', 0) +
        sortTh('Attendee', 1) +
        sortTh('Email', 2) +
        sortTh('Purchaser', 3) +
        sortTh('Type', 4) +
        sortTh('Qty', 5) +
        sortTh('Total', 6) +
        '<th>Check In</th>' +
        '</tr></thead><tbody>';

      $.each(data.orders, function (i, o) {
        html += '<tr>' +
          '<td>#' + escHtml(o.order_id) + '</td>' +
          '<td>' + escHtml(o.first_name) + ' ' + escHtml(o.last_name) + '</td>' +
          '<td>' + escHtml(o.email) + '</td>' +
          '<td>' + escHtml(o.purchaser_first) + ' ' + escHtml(o.purchaser_last) + '</td>' +
          '<td>' + escHtml(o.ticket_type) + '</td>' +
          '<td>' + o.qty + '</td>' +
          '<td>$' + escHtml(o.total_price) + '</td>' +
          '<td>' + checkinBtns(o.tickets) + '</td>' +
          '</tr>';
      });

      html += '</tbody></table></div>';
      html += '<button class="btn btn-secondary btn-sm mt-2" id="export-event-csv">Export CSV</button>';

      $eventResults.html(html);
    });
  });

  // Export event CSV
  $(document).on('click', '#export-event-csv', function () {
    var rows = [];
    var $table = $eventResults.find('table');
    $table.find('tr').each(function () {
      var row = [];
      $(this).find('th, td').each(function () {
        row.push('"' + $(this).text().replace(/"/g, '""') + '"');
      });
      rows.push(row.join(','));
    });
    downloadCSV(rows.join('\n'), 'event-tickets.csv');
  });

  // Customer search
  $searchBtn.on('click', doCustomerSearch);
  $customerSearch.on('keypress', function (e) {
    if (e.which === 13) doCustomerSearch();
  });

  function doCustomerSearch() {
    var query = $.trim($customerSearch.val());
    if (query.length < 2) {
      $customerResults.html('<p class="text-warning">Please enter at least 2 characters.</p>');
      return;
    }

    $customerResults.html('<p class="text-muted">Searching...</p>');

    $.post(ticketReport.ajax_url, {
      action: 'tr_search_customer',
      nonce: ticketReport.nonce,
      query: query
    }, function (res) {
      if (!res.success || !res.data.length) {
        $customerResults.html('<p>No results found for "' + escHtml(query) + '".</p>');
        return;
      }

      var html = '<div class="table-responsive"><table class="table table-striped table-hover">' +
        '<thead><tr>' +
        sortTh('Order', 0) +
        sortTh('Event', 1) +
        sortTh('Attendee', 2) +
        sortTh('Email', 3) +
        sortTh('Purchaser', 4) +
        sortTh('Type', 5) +
        sortTh('Qty', 6) +
        sortTh('Total', 7) +
        '<th>Check In</th>' +
        '</tr></thead><tbody>';

      $.each(res.data, function (i, o) {
        html += '<tr>' +
          '<td>#' + escHtml(o.order_id) + '</td>' +
          '<td>' + escHtml(o.event_name) + '</td>' +
          '<td>' + escHtml(o.first_name) + ' ' + escHtml(o.last_name) + '</td>' +
          '<td>' + escHtml(o.email) + '</td>' +
          '<td>' + escHtml(o.purchaser_first) + ' ' + escHtml(o.purchaser_last) + '</td>' +
          '<td>' + escHtml(o.ticket_type) + '</td>' +
          '<td>' + o.qty + '</td>' +
          '<td>$' + escHtml(o.total_price) + '</td>' +
          '<td>' + checkinBtns(o.tickets) + '</td>' +
          '</tr>';
      });

      html += '</tbody></table></div>';
      html += '<button class="btn btn-secondary btn-sm mt-2" id="export-customer-csv">Export CSV</button>';

      $customerResults.html(html);
    });
  }

  // Export customer CSV
  $(document).on('click', '#export-customer-csv', function () {
    var rows = [];
    var $table = $customerResults.find('table');
    $table.find('tr').each(function () {
      var row = [];
      $(this).find('th, td').each(function () {
        row.push('"' + $(this).text().replace(/"/g, '""') + '"');
      });
      rows.push(row.join(','));
    });
    downloadCSV(rows.join('\n'), 'customer-tickets.csv');
  });

  function escHtml(str) {
    if (!str) return '';
    return $('<span>').text(str).html();
  }

  function downloadCSV(csv, filename) {
    var blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
    var link = document.createElement('a');
    link.href = URL.createObjectURL(blob);
    link.download = filename;
    link.click();
  }

})(jQuery);
