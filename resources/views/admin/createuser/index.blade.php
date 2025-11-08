@extends('layouts.admin')

@section('page-title', 'Manajemen User')

@include('partials.table-styles')

@section('content')

<div class="data-table-container">
    <div class="table-header">
        <h2 class="table-title">Daftar User</h2>
        <div class="table-actions">
            <div class="search-box">
                <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.35-4.35"></path>
                </svg>
                <input type="text" id="searchInput" placeholder="Cari user...">
            </div>
            <div class="action-buttons">
                <button class="btn btn-success" onclick="openCreateModal()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <line x1="19" y1="8" x2="19" y2="14"></line>
                        <line x1="16" y1="11" x2="22" y2="11"></line>
                    </svg>
                    Create User
                </button>
            </div>
        </div>
    </div>

    <div class="table-wrapper" id="tableWrapper">
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Email</th>
                    <th>Tanggal Dibuat</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @forelse($users ?? [] as $user)
                <tr>
                    <td>
                        <div class="user-cell">
                            <div class="user-info-text">
                                <p>{{ $user->name }}</p>
                            </div>
                        </div>
                    </td>
                    <td data-label="NIM">{{ $user->nim ?? '-' }}</td>
                    <td data-label="Email">
                        <span class="badge badge-email">{{ $user->email }}</span>
                    </td>
                    <td data-label="Tanggal Dibuat">{{ $user->created_at->format('d M Y') }}</td>
                    <td data-label="Action">
                        <div class="action-icons">
                            <button class="icon-btn icon-btn-success" onclick="openEditModal({{ $user->toJson() }})" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"></path>
                                </svg>
                            </button>
                            <button class="icon-btn icon-btn-danger" onclick="deleteUser({{ $user->id }})" title="Delete">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 6h18"></path>
                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">
                        <div class="empty-state">
                            <svg class="empty-state-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <line x1="19" y1="8" x2="19" y2="14"></line>
                                <line x1="16" y1="11" x2="22" y2="11"></line>
                            </svg>
                            <p>Belum ada data user</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Create User Modal -->
<div class="modal-edit" id="createModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Tambah User Baru</h3>
        </div>
        <form id="createForm" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" id="createName" class="form-control" placeholder="Masukkan nama lengkap" required>
                </div>
                <div class="form-group">
                    <label>NIM</label>
                    <input type="text" name="nim" id="createNim" class="form-control" placeholder="Masukkan NIM" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" id="createEmail" class="form-control" placeholder="Masukkan email" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" id="createPassword" class="form-control" placeholder="Masukkan password" required>
                </div>
                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="createPasswordConfirmation" class="form-control" placeholder="Konfirmasi password" required>
                </div>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn btn-secondary" onclick="closeCreateModal()">Batal</button>
                <button type="submit" class="btn btn-success">Tambah User</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit User Modal -->
<div class="modal-edit" id="editModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Edit Data User</h3>
        </div>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" id="editName" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>NIM</label>
                    <input type="text" name="nim" id="editNim" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" id="editEmail" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Password Baru (Kosongkan jika tidak ingin mengubah)</label>
                    <input type="password" name="password" id="editPassword" class="form-control" placeholder="Masukkan password baru (opsional)">
                </div>
                <div class="form-group">
                    <label>Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" id="editPasswordConfirmation" class="form-control" placeholder="Konfirmasi password baru">
                </div>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn btn-secondary" onclick="closeEditModal()">Batal</button>
                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

@include('partials.table-scripts')

<script>
    // Open Create Modal
    function openCreateModal() {
        document.getElementById('createModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    // Close Create Modal
    function closeCreateModal() {
        document.getElementById('createModal').classList.remove('active');
        document.getElementById('createForm').reset();
        document.body.style.overflow = '';
    }

    // Open Edit Modal
    function openEditModal(user) {
        document.getElementById('editName').value = user.name;
        document.getElementById('editNim').value = user.nim || '';
        document.getElementById('editEmail').value = user.email;
        document.getElementById('editPassword').value = '';
        document.getElementById('editPasswordConfirmation').value = '';
        document.getElementById('editForm').action = `/admin/createuser/${user.id}`;
        document.getElementById('editModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    // Close Edit Modal
    function closeEditModal() {
        document.getElementById('editModal').classList.remove('active');
        document.getElementById('editForm').reset();
        document.body.style.overflow = '';
    }

    // Create User Form Submit
    document.getElementById('createForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        fetch('{{ route("admin.createuser.store") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                closeCreateModal();
                location.reload();
            } else {
                alert(data.message || 'Terjadi kesalahan saat menambahkan user');
            }
        })
        .catch(err => {
            console.error(err);
            alert('Terjadi kesalahan saat menambahkan user');
        });
    });

    // Edit User Form Submit
    document.getElementById('editForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const form = this;
        const formData = new FormData(form);
        
        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                closeEditModal();
                location.reload();
            } else {
                alert(data.message || 'Terjadi kesalahan saat mengupdate user');
            }
        })
        .catch(err => {
            console.error(err);
            alert('Terjadi kesalahan saat mengupdate user');
        });
    });

    // Delete User
    function deleteUser(id) {
        if (confirm('Apakah Anda yakin ingin menghapus user ini?')) {
            fetch(`/admin/createuser/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(err => {
                console.error(err);
                alert('Terjadi kesalahan saat menghapus user');
            });
        }
    }

    // Close modals when clicking outside
    window.addEventListener('click', function(event) {
        const createModal = document.getElementById('createModal');
        const editModal = document.getElementById('editModal');
        
        if (event.target === createModal) {
            closeCreateModal();
        }
        if (event.target === editModal) {
            closeEditModal();
        }
    });

    // Close modals with ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const createModal = document.getElementById('createModal');
            const editModal = document.getElementById('editModal');
            
            if (createModal.classList.contains('active')) {
                closeCreateModal();
            }
            if (editModal.classList.contains('active')) {
                closeEditModal();
            }
        }
    });
</script>

@endsection