@extends('layouts.admin')

@section('page-title', 'Daftar Beasiswa')

@include('partials.table-styles')

@section('content')

<div class="data-table-container">
    <div class="table-header">
        <h2 class="table-title">Daftar Beasiswa</h2>
        <div class="table-actions">
            <div class="search-box">
                <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.35-4.35"></path>
                </svg>
                <input type="text" id="searchInput" placeholder="Cari beasiswa...">
            </div>
            <div class="action-buttons">
                <a href="{{ route('admin.beasiswa.download-pdf') }}" class="btn btn-success">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7 10 12 15 17 10"></polyline>
                        <line x1="12" y1="15" x2="12" y2="3"></line>
                    </svg>
                    Download PDF
                </a>
                <button class="btn btn-upload" onclick="openUploadModal()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="17 8 12 3 7 8"></polyline>
                        <line x1="12" y1="3" x2="12" y2="15"></line>
                    </svg>
                    Upload File
                </button>
            </div>
        </div>
    </div>

    <div class="table-wrapper" id="tableWrapper">
        <table>
            <thead>
                <tr>
                    <th>Nama Mahasiswa</th>
                    <th>Email</th>
                    <th>NIM</th>
                    <th>Jenis Beasiswa</th>
                    <th>Jurusan</th>
                    <th>Tahun Ajaran</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @forelse($beasiswas ?? [] as $beasiswa)
                <tr>
                    <td>
                        <div class="user-cell">
                            <div class="user-info-text">
                                <p>{{ $beasiswa->nama_mahasiswa }}</p>
                            </div>
                        </div>
                    </td>
                    <td data-label="Email">{{ $beasiswa->email ?? '-' }}</td>
                    <td data-label="NIM">{{ $beasiswa->nim ?? '-' }}</td>
                    <td data-label="Jenis Beasiswa">{{ $beasiswa->jenis_beasiswa }}</td>
                    <td data-label="Jurusan">{{ $beasiswa->jurusan ?? '-' }}</td>
                    <td data-label="Tahun Ajaran">{{ $beasiswa->tahun_ajaran }}</td>
                    <td data-label="Action">
                        <div class="action-icons">
                            <button class="icon-btn icon-btn-success" onclick="openEditModal({{ $beasiswa->toJson() }})" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"></path>
                                </svg>
                            </button>
                            <button class="icon-btn icon-btn-danger" onclick="deleteBeasiswa({{ $beasiswa->id }})" title="Delete">
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
                    <td colspan="7">
                        <div class="empty-state">
                            <svg class="empty-state-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                                <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
                            </svg>
                            <p>Belum ada data beasiswa</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Upload Modal -->
<div class="modal" id="uploadModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Upload File Beasiswa</h3>
        </div>
        <form action="{{ route('admin.beasiswa.upload') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
            @csrf
            <div class="file-upload-area" id="fileUploadArea">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto 16px; color: #a0aec0;">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="17 8 12 3 7 8"></polyline>
                    <line x1="12" y1="3" x2="12" y2="15"></line>
                </svg>
                <p style="color: #4a5568; margin-bottom: 8px; font-weight: 500;">Drag & drop file atau klik untuk browse</p>
                <p style="color: #a0aec0; font-size: 13px;">Format: .xlsx, .xls, .csv (max 2MB)</p>
                <input type="file" name="file" id="fileInput" accept=".xlsx,.xls,.csv" style="display: none;">
            </div>
            <div id="fileInfo" style="margin-bottom: 16px; padding: 12px; background: #edf2f7; border-radius: 8px; display: none;">
                <p style="font-size: 14px; color: #2d3748; font-weight: 500;" id="fileName"></p>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn btn-secondary" onclick="closeUploadModal()">Batal</button>
                <button type="submit" class="btn btn-upload" id="uploadBtn" disabled>Upload</button>
            </div>
        </form>
    </div>
</div>

<div class="modal-edit" id="editModal">
    <div class="modal-content" style="max-width: 600px;">
        <div class="modal-header">
            <h3 class="modal-title">Edit Data Beasiswa</h3>
        </div>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="form-group" style="margin-bottom: 12px;">
                    <label>Nama Mahasiswa</label>
                    <input type="text" name="nama_mahasiswa" id="editNama" class="form-control" required>
                </div>
                <div class="form-group" style="margin-bottom: 12px;">
                    <label>Email</label>
                    <input type="email" name="email" id="editEmail" class="form-control">
                </div>
                <div class="form-group" style="margin-bottom: 12px;">
                    <label>NIM</label>
                    <input type="text" name="nim" id="editNim" class="form-control">
                </div>
                <div class="form-group" style="margin-bottom: 12px;">
                    <label>Jenis Beasiswa</label>
                    <input type="text" name="jenis_beasiswa" id="editJenis" class="form-control">
                </div>
                <div class="form-group" style="margin-bottom: 12px;">
                    <label>Jurusan</label>
                    <input type="text" name="jurusan" id="editJurusan" class="form-control">
                </div>
                <div class="form-group" style="margin-bottom: 20px;">
                    <label>Tahun Ajaran</label>
                    <input type="text" name="tahun_ajaran" id="editTahun" class="form-control">
                </div>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn btn-secondary" onclick="closeEditModal()">Batal</button>
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
</div>

@include('partials.table-scripts')

<script>
    function editBeasiswa(id) {
        alert('Edit beasiswa ID: ' + id + '\n\nImplementasi edit akan ditambahkan');
    }

    function deleteBeasiswa(id) {
        if (confirm('Apakah Anda yakin ingin menghapus data beasiswa ini?')) {
            fetch(`/admin/beasiswa/${id}`, {
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
                alert('Terjadi kesalahan saat menghapus data');
            });
        }
    }

    function openEditModal(beasiswa) {
        document.getElementById('editNama').value = beasiswa.nama_mahasiswa;
        document.getElementById('editEmail').value = beasiswa.email || '';
        document.getElementById('editNim').value = beasiswa.nim || '';
        document.getElementById('editJenis').value = beasiswa.jenis_beasiswa;
        document.getElementById('editJurusan').value = beasiswa.jurusan || '';
        document.getElementById('editTahun').value = beasiswa.tahun_ajaran;
        document.getElementById('editForm').action = `/admin/beasiswa/${beasiswa.id}`;
        document.getElementById('editModal').style.display = 'flex';
    }
</script>

@endsection