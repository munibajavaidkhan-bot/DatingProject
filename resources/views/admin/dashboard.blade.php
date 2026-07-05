{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin-layout')

@section('title', 'Admin Dashboard')
@section('page-title', 'Admin Dashboard')

@section('content')

{{-- Stats Row --}}
<div class="row g-3 mb-4">
    @php
    $cards = [
        ['label'=>'Total Users',   'value'=>$stats['total_users'],    'icon'=>'fa-users',       'color'=>'#ec4899', 'bg'=>'rgba(236,72,153,0.1)'],
        ['label'=>'Active Users',  'value'=>$stats['active_users'],   'icon'=>'fa-user-check',  'color'=>'#22c55e', 'bg'=>'rgba(34,197,94,0.1)'],
        ['label'=>'Total Matches', 'value'=>$stats['total_matches'],  'icon'=>'fa-heart',       'color'=>'#a855f7', 'bg'=>'rgba(168,85,247,0.1)'],
        ['label'=>'New Today',     'value'=>$stats['new_today'],      'icon'=>'fa-user-plus',   'color'=>'#f59e0b', 'bg'=>'rgba(245,158,11,0.1)'],
        ['label'=>'Messages Sent', 'value'=>$stats['total_messages'], 'icon'=>'fa-comments',    'color'=>'#6366f1', 'bg'=>'rgba(99,102,241,0.1)'],
        ['label'=>'Forum Threads', 'value'=>$stats['forum_threads'],  'icon'=>'fa-comments-alt','color'=>'#f43f5e', 'bg'=>'rgba(244,63,94,0.1)'],
        ['label'=>'Blog Posts',    'value'=>$stats['blog_posts'],     'icon'=>'fa-newspaper',   'color'=>'#14b8a6', 'bg'=>'rgba(20,184,166,0.1)'],
        ['label'=>'Accepted Pairs','value'=>$stats['accepted_matches'],'icon'=>'fa-handshake',  'color'=>'#8b5cf6', 'bg'=>'rgba(139,92,246,0.1)'],
    ];
    @endphp

    @foreach($cards as $card)
    <div class="col-6 col-md-3">
        <div class="admin-card">
            <div style="display:flex;align-items:center;justify-content:space-between;">
                <div>
                    <div style="font-size:28px;font-weight:800;color:white;">{{ number_format($card['value']) }}</div>
                    <div style="font-size:12px;color:#9ca3af;margin-top:2px;">{{ $card['label'] }}</div>
                </div>
                <div style="width:48px;height:48px;border-radius:14px;background:{{ $card['bg'] }};display:flex;align-items:center;justify-content:center;">
                    <i class="fas {{ $card['icon'] }}" style="color:{{ $card['color'] }};font-size:20px;"></i>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="row g-4 mb-4">
    {{-- New Users Chart --}}
    <div class="col-lg-8">
        <div class="admin-card">
            <h5 style="font-weight:700;color:white;margin-bottom:20px;">
                <i class="fas fa-chart-line me-2" style="color:#ec4899;"></i>
                New Registrations — Last 7 Days
            </h5>
            <canvas id="usersChart" height="100"></canvas>
        </div>
    </div>

    {{-- User Status Pie --}}
    <div class="col-lg-4">
        <div class="admin-card">
            <h5 style="font-weight:700;color:white;margin-bottom:20px;">
                <i class="fas fa-chart-pie me-2" style="color:#a855f7;"></i>
                User Status
            </h5>
            <canvas id="statusChart" height="200"></canvas>
            <div style="margin-top:16px;">
                @php
                $total = array_sum($userStatus);
                $statusColors = ['active'=>'#22c55e','suspended'=>'#ef4444','pending'=>'#f59e0b'];
                @endphp
                @foreach($userStatus as $status => $count)
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;">
                    <div style="display:flex;align-items:center;gap:8px;">
                        <div style="width:10px;height:10px;border-radius:50%;background:{{ $statusColors[$status] ?? '#9ca3af' }};"></div>
                        <span style="color:#9ca3af;font-size:13px;text-transform:capitalize;">{{ $status }}</span>
                    </div>
                    <span style="color:white;font-weight:700;">{{ $count }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    {{-- Recent Users --}}
    <div class="col-lg-8">
        <div class="admin-card">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
                <h5 style="font-weight:700;color:white;margin:0;">
                    <i class="fas fa-user-clock me-2" style="color:#ec4899;"></i>
                    Recent Registrations
                </h5>
                <a href="{{ route('admin.users.index') }}" style="color:#ec4899;font-size:13px;font-weight:600;text-decoration:none;">
                    View All <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>

            <div style="overflow-x:auto;">
                <table style="width:100%;border-collapse:collapse;">
                    <thead>
                        <tr>
                            @foreach(['User','Email','Role','Status','Joined'] as $h)
                            <th style="text-align:left;padding:8px 12px;font-size:11px;font-weight:700;color:#6b7280;text-transform:uppercase;letter-spacing:1px;border-bottom:1px solid rgba(255,255,255,0.05);">
                                {{ $h }}
                            </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentUsers as $u)
                        <tr style="border-bottom:1px solid rgba(255,255,255,0.04);">
                            <td style="padding:12px;">
                                <div style="display:flex;align-items:center;gap:10px;">
                                    <img src="{{ $u->getAvatarUrl() }}" style="width:34px;height:34px;border-radius:50%;object-fit:cover;">
                                    <span style="color:white;font-size:13px;font-weight:600;">{{ $u->name }}</span>
                                </div>
                            </td>
                            <td style="padding:12px;color:#9ca3af;font-size:13px;">{{ $u->email }}</td>
                            <td style="padding:12px;">
                                <span style="background:{{ $u->role === 'admin' ? 'rgba(239,68,68,0.2)' : ($u->role === 'author' ? 'rgba(168,85,247,0.2)' : 'rgba(236,72,153,0.2)') }};
                                            color:{{ $u->role === 'admin' ? '#ef4444' : ($u->role === 'author' ? '#a855f7' : '#ec4899') }};
                                            font-size:11px;font-weight:700;padding:3px 10px;border-radius:20px;text-transform:capitalize;">
                                    {{ $u->role }}
                                </span>
                            </td>
                            <td style="padding:12px;">
                                <span style="background:{{ $u->status === 'active' ? 'rgba(34,197,94,0.2)' : 'rgba(239,68,68,0.2)' }};
                                            color:{{ $u->status === 'active' ? '#22c55e' : '#ef4444' }};
                                            font-size:11px;font-weight:700;padding:3px 10px;border-radius:20px;text-transform:capitalize;">
                                    {{ $u->status }}
                                </span>
                            </td>
                            <td style="padding:12px;color:#6b7280;font-size:12px;">{{ $u->created_at->format('M d, Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="col-lg-4">
        <div class="admin-card mb-4">
            <h5 style="font-weight:700;color:white;margin-bottom:16px;">
                <i class="fas fa-bolt me-2" style="color:#f59e0b;"></i>
                Quick Actions
            </h5>

            @foreach([
                ['label'=>'View All Users',     'icon'=>'fa-users',     'route'=>'admin.users.index',   'color'=>'#ec4899'],
                ['label'=>'Run Matchmaking',     'icon'=>'fa-heart',     'route'=>'admin.dashboard',     'color'=>'#a855f7', 'artisan'=>true],
                ['label'=>'Manage Blog Posts',   'icon'=>'fa-newspaper', 'route'=>'admin.blog.index',    'color'=>'#6366f1'],
                ['label'=>'Manage Content',      'icon'=>'fa-book',      'route'=>'admin.content.index', 'color'=>'#22c55e'],
                ['label'=>'Forum Moderation',    'icon'=>'fa-comments',  'route'=>'admin.forum',         'color'=>'#f59e0b'],
            ] as $action)
            <a href="{{ route($action['route']) }}"
               style="display:flex;align-items:center;gap:12px;padding:12px;border-radius:12px;background:rgba(255,255,255,0.04);margin-bottom:8px;text-decoration:none;transition:background .2s;"
               onmouseover="this.style.background='rgba(255,255,255,0.08)'"
               onmouseout="this.style.background='rgba(255,255,255,0.04)'">
                <div style="width:36px;height:36px;border-radius:10px;background:{{ $action['color'] }}22;display:flex;align-items:center;justify-content:center;">
                    <i class="fas {{ $action['icon'] }}" style="color:{{ $action['color'] }};font-size:14px;"></i>
                </div>
                <span style="color:white;font-size:13px;font-weight:500;">{{ $action['label'] }}</span>
                <i class="fas fa-chevron-right ms-auto" style="color:#6b7280;font-size:11px;"></i>
            </a>
            @endforeach
        </div>

        {{-- Gender Breakdown --}}
        <div class="admin-card">
            <h5 style="font-weight:700;color:white;margin-bottom:16px;">
                <i class="fas fa-venus-mars me-2" style="color:#ec4899;"></i>
                Gender Breakdown
            </h5>
            @php $total = max(1, array_sum($genderBreakdown)); @endphp
            @foreach([['male','#6366f1','fa-mars'],['female','#ec4899','fa-venus'],['other','#22c55e','fa-genderless']] as [$g,$c,$i])
            <div style="margin-bottom:14px;">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:6px;">
                    <div style="display:flex;align-items:center;gap:8px;">
                        <i class="fas {{ $i }}" style="color:{{ $c }};font-size:14px;"></i>
                        <span style="color:#9ca3af;font-size:13px;text-transform:capitalize;">{{ $g }}</span>
                    </div>
                    <span style="color:white;font-weight:700;font-size:14px;">{{ $genderBreakdown[$g] ?? 0 }}</span>
                </div>
                <div style="background:rgba(255,255,255,0.1);border-radius:20px;height:6px;">
                    <div style="background:{{ $c }};border-radius:20px;height:6px;width:{{ round((($genderBreakdown[$g] ?? 0)/$total)*100) }}%;"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
// Users Chart
const usersCtx = document.getElementById('usersChart').getContext('2d');
new Chart(usersCtx, {
    type: 'line',
    data: {
        labels: {!! json_encode(collect($newUsersChart)->pluck('date')) !!},
        datasets: [{
            label: 'New Users',
            data: {!! json_encode(collect($newUsersChart)->pluck('count')) !!},
            borderColor: '#ec4899',
            backgroundColor: 'rgba(236,72,153,0.1)',
            borderWidth: 2,
            fill: true,
            tension: 0.4,
            pointBackgroundColor: '#ec4899',
            pointRadius: 5,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            x: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: '#9ca3af' } },
            y: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: '#9ca3af', stepSize: 1 }, beginAtZero: true }
        }
    }
});

// Status Pie Chart
const statusCtx = document.getElementById('statusChart').getContext('2d');
new Chart(statusCtx, {
    type: 'doughnut',
    data: {
        labels: ['Active', 'Suspended', 'Pending'],
        datasets: [{
            data: [{{ $userStatus['active'] }}, {{ $userStatus['suspended'] }}, {{ $userStatus['pending'] }}],
            backgroundColor: ['#22c55e', '#ef4444', '#f59e0b'],
            borderWidth: 0,
        }]
    },
    options: {
        responsive: true,
        cutout: '65%',
        plugins: { legend: { display: false } }
    }
});
</script>
@endpush