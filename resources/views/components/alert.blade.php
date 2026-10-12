@props(['type' => 'sukses', 'message' => ''])

@php
  $style = $type === 'sukses'
    ? 'bg-emerald-50 text-emerald-700 border-emerald-200'
    : 'bg-red-50 text-red-700 border-red-200';
@endphp

@if ($message)
  <div {{ $attributes->merge(['class' => "border rounded-lg px-4 py-3 mb-6 text-sm $style"]) }}>
    {{ $message }}
  </div>
@endif
