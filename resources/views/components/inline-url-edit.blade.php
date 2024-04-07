<div>
    @if (!$editing)
    {{$row->url}}
        <button type="button" wire:click="startEditing({{ $row->id }})" class="text-blue">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                <path d="M5.016 15.984v3h3l8.484-8.484-3-3L5.016 15.984zM18.438 7.734c0.281-0.281 0.281-0.703 0-0.984l-1.969-1.969c-0.281-0.281-0.703-0.281-0.984 0l-2.016 2.016 3 3 2.016-2.016z"></path>
          </svg>
          </button>
    @else
    <form wire:submit.prevent="updateUrl({{ $row->id }})">
        <select wire:model="selectedUrl"  wire:change="updateUrl({{ $row->id }})" class="rounded-md">
            <option value="">Select URL</option>
            <option value="https://vip.qojyxayv.com/tracker" @if ($row->url == "https://vip.qojyxayv.com/tracker") selected @endif>https://vip.qojyxayv.com/tracker</option>
            <option value="https://cryp.im/api/v1/web/conversion" @if ($row->url === "https://cryp.im/api/v1/web/conversion") selected @endif>https://cryp.im/api/v1/web/conversion</option>
        </select>
        <button type="button" wire:click="cancelEditing({{ $row->id }})" class="text-blue">X</button>
    </form>
    @endif
</div>
