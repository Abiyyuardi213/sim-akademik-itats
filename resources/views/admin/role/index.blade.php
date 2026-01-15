@extends('layouts.admin')

@section('title', 'Manajemen Peran')

@section('content')
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Manajemen Peran</h1>
            <p class="mt-1 text-sm text-gray-600">Kelola data peran (role) pengguna dan hak akses sistem.</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <a href="{{ route('admin.role.create') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 transition-colors shadow-sm shadow-blue-500/30">
                <i class="fas fa-plus"></i> Tambah Peran
            </a>
        </div>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr
                        class="bg-gray-50 border-b border-gray-100 text-xs uppercase tracking-wider text-gray-500 font-semibold">
                        <th class="px-6 py-4 w-16 text-center">No</th>
                        <th class="px-6 py-4 w-20">ID</th>
                        <th class="px-6 py-4">Nama Peran</th>
                        <th class="px-6 py-4">Deskripsi</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    @forelse($roles as $index => $role)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 text-center text-gray-500">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 font-mono text-gray-500 text-xs">{{ $role->id }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900">
                                <div class="flex items-center gap-2">
                                    <span
                                        class="w-2 h-2 rounded-full {{ $role->role_status ? 'bg-green-500' : 'bg-red-500' }}"></span>
                                    {{ $role->role_name }}
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-500">{{ Str::limit($role->role_description, 60) }}</td>
                            <td class="px-6 py-4 text-center">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" class="sr-only peer toggle-status"
                                        data-role-id="{{ $role->id }}" {{ $role->role_status ? 'checked' : '' }}>
                                    <div
                                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                                    </div>
                                </label>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.role.edit', $role->id) }}"
                                        class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors"
                                        title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button onclick="openDeleteModal('{{ $role->id }}')"
                                        class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                        title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="fas fa-user-shield text-4xl text-gray-300 mb-3"></i>
                                    <p>Belum ada data peran.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Counters -->
        <div
            class="px-6 py-4 border-t border-gray-100 text-sm text-gray-500 flex justify-between items-center bg-gray-50/50">
            <span>Total Peran: <strong>{{ $roles->count() }}</strong></span>
            {{-- If pagination enabled: {{ $roles->links() }} --}}
        </div>
    </div>

    <!-- Custom Delete Modal -->
    <div id="deleteModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity" onclick="closeDeleteModal()"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <!-- Modal Panel -->
                <div
                    class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <i class="fas fa-exclamation-triangle text-red-600"></i>
                            </div>
                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                <h3 class="text-lg font-semibold leading-6 text-gray-900" id="modal-title">Hapus Peran</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Apakah Anda yakin ingin menghapus peran ini? Pastikan
                                        tidak ada pengguna yang sedang menggunakan peran ini. Tindakan ini tidak dapat
                                        dibatalkan.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <form id="deleteForm" method="POST" class="inline-block w-full sm:w-auto">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex w-full justify-center rounded-lg bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto transition-colors">
                                Ya, Hapus
                            </button>
                        </form>
                        <button type="button" onclick="closeDeleteModal()"
                            class="mt-3 inline-flex w-full justify-center rounded-lg bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto transition-colors">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        function openDeleteModal(id) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');
            // Based on previous file: url('role') + '/' + id
            form.action = "{{ url('role') }}/" + id;

            modal.classList.remove('hidden');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
        }

        // Status Toggle
        document.addEventListener('DOMContentLoaded', () => {
            const toggles = document.querySelectorAll('.toggle-status');
            toggles.forEach(toggle => {
                toggle.addEventListener('change', function() {
                    const roleId = this.dataset.roleId;
                    const status = this.checked ? 1 : 0;

                    fetch("{{ url('role') }}/" + roleId + "/toggle-status", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                role_status: status
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Success toast handled by layout if trigger session, but this is async.
                                // We can manually show toast if we had access to the showToast function global.
                                if (typeof showToast === 'function') {
                                    showToast(data.message, 'success');
                                }
                            } else {
                                alert('Gagal update status');
                                this.checked = !this.checked; // Revert
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan');
                            this.checked = !this.checked; // Revert
                        });
                });
            });
        });
    </script>
@endsection
