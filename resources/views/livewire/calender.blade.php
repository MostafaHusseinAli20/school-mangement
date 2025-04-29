<div>
    <script>
        document.addEventListener('livewire:init', () => {
            const events = @js($events);

            // مثال على استخدام FullCalendar أو أي مكتبة مشابهة
            let calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                events: events,
                editable: true,
                selectable: true,
                select: function (info) {
                    Livewire.dispatch('addevent', {
                        title: prompt('Event Title'),
                        start: info.startStr
                    });
                },
                eventDrop: function (info) {
                    Livewire.dispatch('eventDrop', {
                        id: info.event.id,
                        start: info.event.startStr
                    });
                }
            });

            calendar.render();
        });
        select: function (info) {
        Livewire.dispatch('openModal', info.startStr);
        }
    </script>

    <div id="calendar"></div>
</div>

@if($showModal)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white rounded-xl p-6 w-96">
            <h2 class="text-lg font-bold mb-4">إضافة حدث جديد</h2>

            <input type="text" wire:model="newEventTitle" placeholder="عنوان الحدث" class="w-full border p-2 rounded mb-3" />

            <div class="flex justify-end space-x-2">
                <button wire:click="saveEvent" class="bg-blue-500 text-white px-4 py-2 rounded">حفظ</button>
                <button wire:click="$set('showModal', false)" class="bg-gray-300 px-4 py-2 rounded">إلغاء</button>
            </div>
        </div>
    </div>
@endif