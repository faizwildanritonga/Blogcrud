@props(['padded' => true])

<div {{ $attributes->merge(['class' => 'bg-white border border-slate-200 rounded-xl ' . ($padded ? 'p-5' : '')]) }}>
  {{ $slot }}
</div>
