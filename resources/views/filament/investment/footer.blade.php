<td colspan="2" class="px-4 py-3 filament-tables-text-column">
    Total:
</td>

<td class="filament-tables-cell">
    <div class="px-4 py-3 filament-tables-text-column">
        ${{ ($this->getTableRecords()->sum('amount')) }}
    </div>
</td>

<td class="filament-tables-cell">
    <div class="px-4 py-3 filament-tables-text-column">
        ${{ ($this->getTableRecords()->sum('roi')) }}
    </div>
</td>
