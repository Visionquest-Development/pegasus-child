(function ($) {
  'use strict';

  var $eventSelect = $('#event-select');
  var $loadBtn = $('#load-event-btn');
  var $eventResults = $('#event-results');
  var $eventSummary = $('#event-summary');
  var $customerSearch = $('#customer-search');
  var $searchBtn = $('#search-customer-btn');
  var $customerResults = $('#customer-results');

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

  // Build a check-in button
  function checkinBtn(ticketId, status) {
    var isCheckedIn = (status === 'Checked In');
    var btnClass = isCheckedIn ? 'btn-success' : 'btn-outline-secondary';
    var label = isCheckedIn ? 'Checked In' : 'Check In';
    return '<button class="btn btn-sm ' + btnClass + ' tr-checkin-btn" ' +
      'data-ticket-id="' + ticketId + '" data-status="' + escHtml(status) + '">' +
      label + '</button>';
  }

  // Handle check-in toggle (works for both tabs via event delegation)
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

      // Summary
      $eventSummary
        .removeClass('d-none')
        .html(
          '<strong>' + escHtml(data.event_name) + '</strong> &mdash; ' +
          data.total_tickets + ' ticket(s), ' +
          'Total Revenue: $' + data.total_revenue
        );

      if (!data.tickets.length) {
        $eventResults.html('<p>No tickets found for this event.</p>');
        return;
      }

      var html = '<div class="table-responsive"><table class="table table-striped table-hover">' +
        '<thead><tr>' +
        '<th>Order</th>' +
        '<th>Attendee</th>' +
        '<th>Email</th>' +
        '<th>Purchaser</th>' +
        '<th>Type</th>' +
        '<th>Price</th>' +
        '<th>Status</th>' +
        '</tr></thead><tbody>';

      $.each(data.tickets, function (i, t) {
        html += '<tr>' +
          '<td>#' + escHtml(t.order_id) + '</td>' +
          '<td>' + escHtml(t.first_name) + ' ' + escHtml(t.last_name) + '</td>' +
          '<td>' + escHtml(t.email) + '</td>' +
          '<td>' + escHtml(t.purchaser_first) + ' ' + escHtml(t.purchaser_last) + '</td>' +
          '<td>' + escHtml(t.ticket_type) + '</td>' +
          '<td>$' + escHtml(t.price) + '</td>' +
          '<td>' + checkinBtn(t.ticket_id, t.status) + '</td>' +
          '</tr>';
      });

      html += '</tbody></table></div>';

      // Export button
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
        '<th>Order</th>' +
        '<th>Event</th>' +
        '<th>Attendee</th>' +
        '<th>Email</th>' +
        '<th>Purchaser</th>' +
        '<th>Type</th>' +
        '<th>Price</th>' +
        '<th>Status</th>' +
        '</tr></thead><tbody>';

      $.each(res.data, function (i, t) {
        html += '<tr>' +
          '<td>#' + escHtml(t.order_id) + '</td>' +
          '<td>' + escHtml(t.event_name) + '</td>' +
          '<td>' + escHtml(t.first_name) + ' ' + escHtml(t.last_name) + '</td>' +
          '<td>' + escHtml(t.email) + '</td>' +
          '<td>' + escHtml(t.purchaser_first) + ' ' + escHtml(t.purchaser_last) + '</td>' +
          '<td>' + escHtml(t.ticket_type) + '</td>' +
          '<td>$' + escHtml(t.price) + '</td>' +
          '<td>' + checkinBtn(t.ticket_id, t.status) + '</td>' +
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
