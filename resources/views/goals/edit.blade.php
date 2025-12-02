<x-layout class="bg-gray-900 min-h-screen text-gray-100">
<div class="max-w-4xl mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-6">Edit Goal</h2>

    <form action="/goals/update/{{ $goal->slug }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded-md mb-4">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Creator (disabled) -->
        <div>
            <label class="block text-sm font-medium mb-1">Created By</label>
            <input type="text" 
                   class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-md text-gray-300" 
                   value="{{ $goal->projectManager->name }}" disabled>
        </div>

        <!-- SDG Name -->
        <div>
            <label class="block text-sm font-medium mb-1">SDG</label>
            <input type="text" 
                    class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-md text-gray-300" 
                    value="{{ $goal->sdg->name }}" 
                    disabled
            >
            <input type="hidden" name="sdg_id" value="{{ $goal->sdg_id }}">
        </div>

        <!-- Goal Name -->
        <div>
            <label for="goalName" class="block text-sm font-medium mb-1">Goal Name</label>
            <input type="text" name="title" id="goalName" 
                   value="{{ old('title', $goal->title) }}"
                   class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                   required>
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-medium mb-1">Description</label>
            <textarea name="description" id="description" rows="4"
                      class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description', $goal->description) }}</textarea>
        </div>

        <!-- Start and End Dates -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="start_date" class="block text-sm font-medium mb-1">Start Date</label>
                <div class="relative">
                    <input type="text" name="start_date" id="start_date"
                           class="flatpickr-input w-full pl-4 pr-10 py-3 bg-gray-800 border border-gray-700 rounded-md text-gray-200 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200"
                           placeholder="Select start date"
                           value="{{ old('start_date', \Carbon\Carbon::parse($goal->start_date)->format('Y-m-d')) }}" required>
                    <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v9a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm-2 8a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </div>
            </div>

            <div>
                <label for="end_date" class="block text-sm font-medium mb-1">End Date</label>
                <div class="relative">
                    <input type="text" name="end_date" id="end_date"
                           class="flatpickr-input w-full pl-4 pr-10 py-3 bg-gray-800 border border-gray-700 rounded-md text-gray-200 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200"
                           placeholder="Select end date"
                           value="{{ old('end_date', \Carbon\Carbon::parse($goal->end_date)->format('Y-m-d')) }}" required>
                    <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v9a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm-2 8a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </div>
            </div>
        </div>

        <!-- Flatpickr Assets & Init (copied from create.blade.php) -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <style>
            /* Flatpickr single-color theme (#1e2939) with white text + compact size */
            .flatpickr-calendar { background: #1e2939; border: 1px solid #1e2939; border-radius: 10px; overflow: hidden; box-shadow: 0 12px 30px rgba(0,0,0,0.5); }
            .flatpickr-months, .flatpickr-innerContainer, .flatpickr-days, .dayContainer { background: #1e2939; }
            .flatpickr-months .flatpickr-month { height: 34px; }
            .flatpickr-current-month .flatpickr-monthDropdown-months, .flatpickr-current-month input.cur-year { color: #ffffff; font-weight: 600; font-size: 0.9rem; }
            .flatpickr-weekdays { background: transparent; border-bottom: 1px solid #4b5563; }
            .flatpickr-weekdaycontainer { background: transparent; }
            .flatpickr-weekday { color: #ffffff; font-weight: 600; font-size: 0.75rem; line-height: 30px; }
            /* Ensure the weekday label text inside span elements is white (override flatpickr defaults) */
            span.flatpickr-weekday, .flatpickr-weekday span {
                color: #ffffff !important;
            }
            .flatpickr-day { color: #ffffff; background: transparent; border-radius: 8px; height: 30px; line-height: 30px; width: 30px; margin: 2px; border: 1px solid transparent; font-size: 0.9rem; }
            /* Differentiate days from previous/next months */
            .flatpickr-day.prevMonthDay, .flatpickr-day.nextMonthDay, .flatpickr-day.notCurrentMonth { color: rgba(255,255,255,0.55); }
            /* Make hover for other-month days match regular day hover (no bright white on hover) */
            .flatpickr-day.prevMonthDay:hover, .flatpickr-day.nextMonthDay:hover, .flatpickr-day.notCurrentMonth:hover {
                color: rgba(255,255,255,0.55) !important;
                background: transparent !important;
                border-color: rgba(255,255,255,0.25) !important;
            }
            /* Keep disabled days visibly disabled but readable */
            .flatpickr-day.flatpickr-disabled, .flatpickr-day.flatpickr-disabled:hover { color: rgba(255,255,255,0.35) !important; border-color: transparent !important; cursor: not-allowed; }
            .flatpickr-day:hover { border-color: rgba(255,255,255,0.25); background: transparent; }
            .flatpickr-day.today { border-color: rgba(255,255,255,0.4); }
            .flatpickr-day.selected, .flatpickr-day.startRange, .flatpickr-day.endRange, .flatpickr-day.selected:hover { background: transparent; border-color: #ffffff; color: #ffffff; box-shadow: inset 0 0 0 1px #ffffff; }
            .flatpickr-prev-month, .flatpickr-next-month { color: #ffffff; fill: #ffffff; }
            .flatpickr-prev-month:hover, .flatpickr-next-month:hover { color: #ffffff; fill: #ffffff; opacity: .85; }
            /* Blend the month dropdown with the dark calendar theme (soft, low-contrast colors) */
            .flatpickr-current-month .flatpickr-monthDropdown-months,
            .flatpickr-monthDropdown-months,
            .flatpickr-monthDropdown-months option {
                background: #1e2939!important; /* darker, not pure black */
                color: #d6e3f2 !important;      /* soft off-white */
                border-color: transparent !important;
            }
            .flatpickr-monthDropdown-months option:hover {
                background: rgba(255,255,255,0.04) !important;
                color: #ffffff !important;
            }
        </style>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const today = new Date();
                const oldStart = "{{ old('start_date', \Carbon\Carbon::parse($goal->start_date)->format('Y-m-d')) }}";
                const oldEnd = "{{ old('end_date', \Carbon\Carbon::parse($goal->end_date)->format('Y-m-d')) }}";

                // End date first so start picker can reference it safely
                const endPicker = flatpickr('#end_date', {
                    dateFormat: 'Y-m-d',
                    minDate: oldStart || today,
                    defaultDate: oldEnd || null,
                    disableMobile: true,
                    allowInput: true,
                });

                const startPicker = flatpickr('#start_date', {
                    dateFormat: 'Y-m-d',
                    minDate: today,
                    defaultDate: oldStart || null,
                    disableMobile: true,
                    allowInput: true,
                    onChange: function(selectedDates) {
                        if (selectedDates[0]) {
                            endPicker.set('minDate', selectedDates[0]);
                            if (endPicker.selectedDates[0] && endPicker.selectedDates[0] < selectedDates[0]) {
                                endPicker.clear();
                            }
                        } else {
                            endPicker.set('minDate', today);
                        }
                    }
                });

                /* Utility to convert config dates to Date objects */
                function toDate(val) {
                    if (!val) return null;
                    if (val instanceof Date) return val;
                    try { return new Date(val); } catch (e) { return null; }
                }

                /* Hide/show prev/next buttons when at min/max month limits */
                function updateNavButtons(instance) {
                    try {
                        var cal = instance.calendarContainer;
                        if (!cal) return;
                        var prev = cal.querySelector('.flatpickr-prev-month');
                        var next = cal.querySelector('.flatpickr-next-month');
                        var min = toDate(instance.config.minDate);
                        var max = toDate(instance.config.maxDate);
                        var cy = instance.currentYear, cm = instance.currentMonth;

                        if (max && next) {
                            var My = max.getFullYear(), MM = max.getMonth();
                            if (cy > My || (cy === My && cm >= MM)) next.style.display = 'none';
                            else next.style.display = '';
                        } else if (next) next.style.display = '';

                        if (min && prev) {
                            var my = min.getFullYear(), mm = min.getMonth();
                            if (cy < my || (cy === my && cm <= mm)) prev.style.display = 'none';
                            else prev.style.display = '';
                        } else if (prev) prev.style.display = '';
                    } catch (e) {
                        console.warn('updateNavButtons error', e);
                    }
                }

                /* Disable/hide month options that are before the allowed min (for current year) */
                function updateMonthDropdown(instance) {
                    try {
                        var cal = instance.calendarContainer;
                        if (!cal) return;
                        var select = cal.querySelector('.flatpickr-monthDropdown-months');
                        if (!select) return;
                        var min = toDate(instance.config.minDate);
                        var max = toDate(instance.config.maxDate);
                        var selectedYear = instance.currentYear;

                        for (var i = 0; i < select.options.length; i++) {
                            var opt = select.options[i];
                            var monthIndex = i; // option index corresponds to month 0-11
                            var disable = false;

                            // If minDate exists, disable months earlier than minDate in that year
                            if (min && selectedYear <= min.getFullYear()) {
                                if (selectedYear < min.getFullYear() || monthIndex < min.getMonth()) disable = true;
                            }

                            // If maxDate exists, disable months after maxDate in that year
                            if (max && selectedYear >= max.getFullYear()) {
                                if (selectedYear > max.getFullYear() || monthIndex > max.getMonth()) disable = true;
                            }

                            opt.disabled = disable;
                            opt.style.opacity = disable ? '0.35' : '';
                        }
                    } catch (e) {
                        console.warn('updateMonthDropdown error', e);
                    }
                }

                // Attach small handlers to keep nav buttons and month dropdown updated
                [startPicker, endPicker].forEach(function(inst) {
                    // ensure config arrays exist and push update functions so they're called on open/month/year change
                    inst.config.onOpen = inst.config.onOpen || [];
                    inst.config.onOpen.push(function() { setTimeout(function(){ updateNavButtons(inst); }, 0); });
                    inst.config.onMonthChange = inst.config.onMonthChange || [];
                    inst.config.onMonthChange.push(function() { setTimeout(function(){ updateNavButtons(inst); }, 0); });
                    inst.config.onYearChange = inst.config.onYearChange || [];
                    inst.config.onYearChange.push(function() { setTimeout(function(){ updateNavButtons(inst); }, 0); });

                    // run once to initialize state (if calendar already rendered)
                    setTimeout(function(){ updateNavButtons(inst); }, 10);
                });

                // Enforce min end date on load when start is pre-filled
                if (startPicker.selectedDates[0]) {
                    endPicker.set('minDate', startPicker.selectedDates[0]);
                }
            });
        </script>

        <!-- Status and Type -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="status" class="block text-sm font-medium mb-1">Status</label>
                <select name="status" id="status"
                        class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                        required>
                    <option value="pending" {{ $goal->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in-progress" {{ $goal->status == 'in-progress' ? 'selected' : '' }}>In-Progress</option>
                    <option value="completed" {{ $goal->status == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <div>
                <label for="type" class="block text-sm font-medium mb-1">Type</label>
                <select name="type" id="type"
                        class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                        required>
                    <option value="short" {{ $goal->type == 'short' ? 'selected' : '' }}>Short Term</option>
                    <option value="long" {{ $goal->type == 'long' ? 'selected' : '' }}>Long Term</option>
                </select>
            </div>
        </div>

        <!-- Assigned Staffs -->
        @if ($staffUsers->isEmpty())
          <div class="bg-gray-800 p-4 rounded-md text-sm text-gray-400">
              No staff available to assign.
          </div>
        @else
          <div>
            <label class="block text-sm font-medium mb-1">Assign to Staff</label>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                @foreach ($staffUsers as $person)
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="assigned_users[]" value="{{ $person->id }}" 
                               class="form-checkbox text-blue-500"
                               {{ in_array($person->id, $goal->assignedUsers->pluck('id')->toArray()) ? 'checked' : '' }}>
                        <span>{{ $person->name }}</span>
                    </label>
                @endforeach
            </div>
          </div>
        @endif

        <!-- Submit -->
        <button type="submit" 
                class="px-6 py-2 bg-blue-600 hover:bg-blue-700 rounded-md font-medium transition-colors duration-200">
            Update Goal
        </button>
    </form>
  </div>
</x-layout>