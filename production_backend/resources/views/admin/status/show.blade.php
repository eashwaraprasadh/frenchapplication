@extends('layouts.admin')

@section('title', 'Status Report: ' . $student->name)

@section('content')
<style>
    /* Excel-like Grid Styles (Read Only) */
    .spreadsheet-container {
        overflow-x: auto;
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
    }
    
    .sheet-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        min-width: 1000px;
    }
    
    .sheet-table th, .sheet-table td {
        border-bottom: 1px solid #e2e8f0;
        border-right: 1px solid #e2e8f0;
        font-size: 0.95rem;
        vertical-align: middle;
    }

    .sheet-table tr:last-child td {
        border-bottom: none;
    }
    
    .sheet-table th {
        background: #f8fafc;
        padding: 16px;
        color: #475569;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
        text-align: left;
        border-top: none;
    }
    
    .sheet-table th:first-child {
        border-top-left-radius: 12px;
    }

    .sheet-table th:last-child {
        border-top-right-radius: 12px;
        border-right: none;
    }
    
    /* Read-Only Cell Styling */
    .sheet-cell {
        padding: 12px 16px;
        min-height: 48px;
        cursor: default;
        display: block;
        color: #334155;
        background-color: #fff;
    }
    
    .sheet-cell:empty::before {
        content: '-';
        color: #cbd5e1;
    }

    .date-cell {
        background-color: #fcfcfc;
        color: #0f172a;
        font-weight: 600;
        padding: 16px;
    }

    .day-cell {
        background-color: #fcfcfc;
        color: #64748b;
        font-weight: 500;
        padding: 16px;
    }

    .total-time-badge {
        display: inline-block;
        padding: 4px 8px;
        background: #e0f2fe;
        color: #0369a1;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
        margin-top: 8px;
    }
    
    .empty-day-row {
        background-color: #f8fafc;
        color: #94a3b8;
        font-style: italic;
        padding: 12px 16px;
        text-align: center;
    }
</style>

<div class="container-fluid py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-end mb-5">
        <div>
            <h1 class="h3 mb-1">Status Report: {{ $student->name }}</h1>
            <p class="text-muted">{{ $student->email }}</p>
        </div>
        
        <div class="d-flex gap-3 align-items-center bg-white p-2 rounded-pill shadow-sm border">
            <a href="{{ route('admin.status.show', ['student' => $student->id, 'month' => $date->copy()->subMonth()->format('Y-m')]) }}" class="btn btn-light btn-sm rounded-circle" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-chevron-left"></i>
            </a>
            <span class="fw-bold text-dark mx-2" style="min-width: 120px; text-align: center;">{{ $date->format('F Y') }}</span>
            <a href="{{ route('admin.status.show', ['student' => $student->id, 'month' => $date->copy()->addMonth()->format('Y-m')]) }}" class="btn btn-light btn-sm rounded-circle" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-chevron-right"></i>
            </a>
        </div>
    </div>

    <!-- Tracker Table -->
    <div class="spreadsheet-container">
        <table class="sheet-table">
            <thead>
                <tr>
                    <th style="width: 120px;">Date</th>
                    <th style="width: 140px;">Day</th>
                    <th>Topics Learned</th>
                    <th style="width: 110px;">Start</th>
                    <th style="width: 110px;">End</th>
                    <th style="width: 110px;">Duration</th>
                </tr>
            </thead>
            <tbody>
                @foreach($days as $day)
                    @php 
                        $dateStr = $day['date']->format('Y-m-d');
                        $status = $day['status'];
                        $topics = $status ? $status->topics : collect();
                        // If no topics, rowcount is 1 (to show "No entry")
                        $rowCount = $topics->count() > 0 ? $topics->count() : 1;
                    @endphp
                    
                    <tr data-date="{{ $dateStr }}">
                        {{-- Date & Day Columns --}}
                        <td rowspan="{{ $rowCount }}" class="date-cell text-center" style="vertical-align: top;">
                            <div class="d-flex flex-column align-items-center">
                                <span class="fs-5">{{ $day['date']->format('d') }}</span>
                                <span class="small text-muted text-uppercase">{{ $day['date']->format('M') }}</span>
                            </div>
                            <!-- Helper for totals (calculated via JS for consistency) -->
                            <div class="total-time-badge d-none" id="total-badge-{{ $dateStr }}"></div>
                        </td>
                        <td rowspan="{{ $rowCount }}" class="day-cell text-center" style="vertical-align: top;">
                            {{ $day['date']->format('l') }}
                        </td>

                        @if($topics->count() > 0)
                            @php $firstTopic = $topics->first(); @endphp
                            <td>
                                <div class="sheet-cell">{{ $firstTopic->topic }}</div>
                            </td>
                            <td>
                                <div class="sheet-cell">{{ $firstTopic->starting_time }}</div>
                            </td>
                            <td>
                                <div class="sheet-cell">{{ $firstTopic->ending_time }}</div>
                            </td>
                            <td>
                                <div class="sheet-cell" data-field="duration">{{ $firstTopic->duration }}</div>
                            </td>
                        @else
                             <td colspan="4">
                                <div class="empty-day-row">No entry</div>
                            </td>
                        @endif
                    </tr>

                    @if($topics->count() > 1)
                        @foreach($topics->slice(1) as $topic)
                        <tr data-date="{{ $dateStr }}">
                            <td>
                                <div class="sheet-cell">{{ $topic->topic }}</div>
                            </td>
                            <td>
                                <div class="sheet-cell">{{ $topic->starting_time }}</div>
                            </td>
                            <td>
                                <div class="sheet-cell">{{ $topic->ending_time }}</div>
                            </td>
                            <td>
                                <div class="sheet-cell" data-field="duration">{{ $topic->duration }}</div>
                            </td>
                        </tr>
                        @endforeach
                    @endif

                    {{-- No "Add" row for Admin --}}

                @endforeach
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        calculateAllTotals();
    });

    function updateDailyTotal(dateStr) {
        const rows = document.querySelectorAll(`tr[data-date="${dateStr}"]`);
        let totalMinutes = 0;

        rows.forEach(row => {
            const durationCell = row.querySelector('[data-field="duration"]');
            if (durationCell) {
                const text = durationCell.textContent.trim();
                 const match = text.match(/(\d+)h\s*(\d+)m/);
                 if (match) {
                     totalMinutes += (parseInt(match[1]) * 60) + parseInt(match[2]);
                 }
            }
        });

        const totalHours = Math.floor(totalMinutes / 60);
        const mins = totalMinutes % 60;
        
        const badge = document.getElementById(`total-badge-${dateStr}`);
        if (badge) {
            if (totalMinutes > 0) {
                badge.textContent = `${totalHours}h ${mins}m`;
                badge.classList.remove('d-none');
            } else {
                badge.classList.add('d-none');
            }
        }
    }

    function calculateAllTotals() {
        const uniqueDates = [...new Set([...document.querySelectorAll('tr[data-date]')].map(r => r.dataset.date))];
        uniqueDates.forEach(date => updateDailyTotal(date));
    }
</script>
@endpush
@endsection
