@extends('layouts.admin-layout')

@section('title', 'Content Weeks')
@section('page-title', 'Manage 52-Week Content')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
  <p style="color:#9ca3af;font-size:14px;margin:0;">{{ $weeks->count() }} weeks · {{ $published }} published</p>
</div>

<div class="admin-card" style="padding:0;overflow:hidden;">
  <table style="width:100%;border-collapse:collapse;">
    <thead>
      <tr style="border-bottom:1px solid rgba(255,255,255,0.06);">
        @foreach(['Week','Title','Category','Premium','Published','Actions'] as $h)
        <th style="padding:14px 20px;text-align:left;font-size:11px;font-weight:700;color:#6b7280;text-transform:uppercase;">{{ $h }}</th>
        @endforeach
      </tr>
    </thead>
    <tbody>
      @foreach($weeks as $week)
      <tr style="border-bottom:1px solid rgba(255,255,255,0.04);">
        <td style="padding:14px 20px;color:#ec4899;font-weight:700;font-size:14px;">W{{ $week->week_number }}</td>
        <td style="padding:14px 20px;color:white;font-size:14px;">{{ Str::limit($week->title, 45) }}</td>
        <td style="padding:14px 20px;color:#9ca3af;font-size:13px;">{{ $week->category ?? '—' }}</td>
        <td style="padding:14px 20px;">
          @if($week->is_premium)
          <span style="color:#f59e0b;font-size:12px;"><i class="fas fa-crown"></i> Premium</span>
          @else
          <span style="color:#22c55e;font-size:12px;">Free</span>
          @endif
        </td>
        <td style="padding:14px 20px;">
          <span style="color:{{ $week->is_published ? '#22c55e' : '#6b7280' }};font-size:12px;font-weight:600;">
            {{ $week->is_published ? 'Yes' : 'No' }}
          </span>
        </td>
        <td style="padding:14px 20px;">
          <a href="{{ route('admin.content.edit', $week->id) }}" style="color:#a855f7;font-size:13px;text-decoration:none;"><i class="fas fa-edit"></i></a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection
