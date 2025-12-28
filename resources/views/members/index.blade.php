@extends('layouts.app')

@section('title', 'Members')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Members</h1>
            <div>
                <a href="{{ route('overview') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Overview</a>
                <a href="{{ route('members.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Member</a>
                <a href="{{ route('members.showUploadForm') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Upload Members</a>
                <a href="{{ route('members.export') }}" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">Export Members</a>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{!! session('error') !!}</span>
            </div>
        @endif

        <div class="mb-4 flex flex-col sm:flex-row sm:justify-between sm:items-center">
            <form action="{{ route('members.index') }}" method="GET" class="flex-grow flex items-center mb-2 sm:mb-0">
                <input type="hidden" name="limit" value="{{ request('limit', 10) }}">
                <input type="text" name="search" placeholder="Search..." class="px-4 py-2 border rounded w-full mr-2" value="{{ request('search') }}">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Search</button>
            </form>

            <div class="flex items-center sm:ml-4">
                <form action="{{ route('members.massDestroy') }}" method="POST" id="mass-delete-form" class="inline-block mr-4">
                    @csrf
                    @method('DELETE')
                    <button type="submit" id="delete-selected-btn" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" disabled>
                        Delete Selected <span id="selected-count">(0)</span>
                    </button>
                </form>
                <label for="pagination_limit" class="mr-2">Show:</label>
                <select name="pagination_limit" id="pagination_limit" class="px-4 py-2 border rounded">
                    <option value="10" {{ request('limit') == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('limit') == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('limit') == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('limit') == 100 ? 'selected' : '' }}>100</option>
                </select>
            </div>
        </div>

        @if ($members->isEmpty())
            <p class="text-gray-700">No members found.</p>
        @else
            <div class="overflow-x-auto">
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2"><input type="checkbox" id="select-all"></th>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Member Number</th>
                            <th class="px-4 py-2">Age</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Phone Number</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($members as $member)
                            <tr class="member-row" data-member-id="{{ $member->id }}">
                                <td class="border px-4 py-2 text-center">
                                    <input type="checkbox" name="selected_members[]" value="{{ $member->id }}" class="member-checkbox">
                                </td>
                                <td class="border px-4 py-2">{{ $member->name }}</td>
                                <td class="border px-4 py-2">{{ $member->member_number }}</td>
                                <td class="border px-4 py-2">{{ $member->age }}</td>
                                <td class="border px-4 py-2">{{ $member->email }}</td>
                                <td class="border px-4 py-2">{{ $member->phone_number }}</td>
                                <td class="border px-4 py-2">
                                    <div class="relative" x-data="{ open: false }">
                                        <button @click="open = !open" class="p-2 rounded-full hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-400">
                                            <i class="fa-solid fa-bars"></i>
                                        </button>
                                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
                                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 view-more-btn">View More</a>
                                            <a href="{{ route('members.edit', $member->id) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit</a>
                                            <form action="{{ route('members.destroy', $member->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this member?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $members->appends(['search' => request('search'), 'limit' => request('limit')])->links() }}
            </div>
        @endif
    </div>

    <!-- Member Details Modal -->
    <div id="member-details-modal" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg p-8 max-w-2xl w-full">
            <h2 class="text-2xl font-bold mb-4" id="modal-member-name"></h2>
            <div id="modal-member-details"></div>
            <button id="close-modal-btn" class="mt-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Close</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('select-all');
            const memberCheckboxes = document.querySelectorAll('.member-checkbox');
            const deleteSelectedBtn = document.getElementById('delete-selected-btn');
            const massDeleteForm = document.getElementById('mass-delete-form');
            const paginationLimitSelect = document.getElementById('pagination_limit');
            const selectedCountSpan = document.getElementById('selected-count');

            function updateSelectedCount() {
                const count = document.querySelectorAll('.member-checkbox:checked').length;
                selectedCountSpan.textContent = `(${count})`;
            }

            function toggleDeleteButton() {
                const anyChecked = Array.from(memberCheckboxes).some(checkbox => checkbox.checked);
                deleteSelectedBtn.disabled = !anyChecked;
            }

            selectAllCheckbox.addEventListener('change', function() {
                memberCheckboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
                toggleDeleteButton();
                updateSelectedCount();
            });

            memberCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    if (!this.checked) {
                        selectAllCheckbox.checked = false;
                    } else {
                        const allChecked = Array.from(memberCheckboxes).every(cb => cb.checked);
                        selectAllCheckbox.checked = allChecked;
                    }
                    toggleDeleteButton();
                    updateSelectedCount();
                });
            });

            // Initial check for button state on page load
            toggleDeleteButton();

            massDeleteForm.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent default form submission

                const selectedIds = Array.from(memberCheckboxes)
                                        .filter(checkbox => checkbox.checked)
                                        .map(checkbox => checkbox.value);

                if (selectedIds.length === 0) {
                    alert('Please select at least one member to delete.');
                    return;
                }

                if (confirm('Are you sure you want to delete the selected members? This action cannot be undone.')) {
                    // Create a hidden input to hold the list of IDs
                    const idsInput = document.createElement('input');
                    idsInput.type = 'hidden';
                    idsInput.name = 'ids';
                    idsInput.value = JSON.stringify(selectedIds);
                    massDeleteForm.appendChild(idsInput);

                    massDeleteForm.submit(); // Submit the form with selected IDs
                }
            });

            paginationLimitSelect.addEventListener('change', function() {
                const url = new URL(window.location.href);
                url.searchParams.set('limit', this.value);
                // Preserve search term if present
                const searchTermInput = document.querySelector('input[name="search"]');
                if (searchTermInput && searchTermInput.value) {
                    url.searchParams.set('search', searchTermInput.value);
                } else {
                    url.searchParams.delete('search');
                }
                window.location.href = url.toString();
            });

            const modal = document.getElementById('member-details-modal');
            const closeModalBtn = document.getElementById('close-modal-btn');

            closeModalBtn.addEventListener('click', () => {
                modal.classList.add('hidden');
            });

            const viewMoreBtns = document.querySelectorAll('.view-more-btn');
            viewMoreBtns.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const memberId = this.closest('.member-row').dataset.memberId;
                    fetch(`/members/${memberId}/details`)
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('modal-member-name').textContent = data.name;
                            const detailsContainer = document.getElementById('modal-member-details');
                            detailsContainer.innerHTML = `
                                <p><strong>Member Number:</strong> ${data.member_number}</p>
                                <p><strong>Email:</strong> ${data.email}</p>
                                <p><strong>Phone Number:</strong> ${data.phone_number}</p>
                                <p><strong>Member Type:</strong> ${data.member_type}</p>
                                <p><strong>DOB:</strong> ${data.date_of_birth}</p>
                                <p><strong>Age:</strong> ${data.age}</p>
                                <p><strong>DOJ:</strong> ${data.doj}</p>
                                <p><strong>Profession:</strong> ${data.profession}</p>
                                <p><strong>Race:</strong> ${data.race}</p>
                                <p><strong>Minimum Spent:</strong> ${data.minimum_spent}</p>
                                <div>
                                    <strong>Subscriptions:</strong>
                                    <div class="flex flex-wrap">
                                        ${Object.entries(data.subscriptions_by_year).map(([year, amount]) => `
                                            <div class="px-2 py-1 border mr-1 mb-1">
                                                <span class="font-bold">${year}:</span>
                                                Ksh ${amount}
                                            </div>
                                        `).join('')}
                                    </div>
                                </div>
                            `;
                            modal.classList.remove('hidden');
                        });
                });
            });
        });
    </script>
@endsection
