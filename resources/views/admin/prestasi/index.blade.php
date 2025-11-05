@extends('layouts.admin')

@section('page-title', 'Dashboard Prestasi')

@include('partials.table-styles')

@section('content')

<div class="data-table-container">
    <div class="table-header">
        <h2 class="table-title">Daftar Prestasi Mahasiswa</h2>
        <div class="table-actions">
            <div class="search-box">
                <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.35-4.35"></path>
                </svg>
                <input type="text" id="searchInput" placeholder="Search">
            </div>
            <div class="action-buttons">
                <a href="{{ route('admin.prestasi.download-pdf') }}" class="btn btn-success">
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

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Nama Mahasiswa</th>
                    <th>Email</th>
                    <th>NIM</th>
                    <th>Prestasi</th>
                    <th>Tingkat</th>
                    <th>Penyelenggara</th>
                    <th>Tahun</th>
                    <th>Jurusan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @forelse($prestasis ?? [] as $prestasi)
                <tr>
                    <td>
                        <div class="user-cell">
                            <div class="user-info-text">
                                <p>{{ $prestasi->nama_mahasiswa }}</p>
                            </div>
                        </div>
                    </td>
                    <td data-label="Email">{{ $prestasi->email ?? '-' }}</td>
                    <td data-label="NIM">{{ $prestasi->nim ?? '-' }}</td>
                    <td data-label="Jenis Prestasi">{{ $prestasi->jenis_prestasi }}</td>
                    <td data-label="Tingkat">
                        <span class="badge-tingkat badge-{{ strtolower($prestasi->tingkat ?? 'lokal') }}">
                            {{ ucfirst($prestasi->tingkat ?? 'Lokal') }}
                        </span>
                    </td>
                    <td data-label="Penyelenggara">{{ $prestasi->penyelenggara ?? '-' }}</td>
                    <td data-label="Tahun">{{ $prestasi->tahun ?? '-' }}</td>
                    <td data-label="Jurusan">{{ $prestasi->jurusan ?? '-' }}</td>
                    <td data-label="Action">
                        <div class="action-icons">
                            <button class="icon-btn icon-btn-success" onclick="openEditModal({{ $prestasi->toJson() }})" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"></path>
                                </svg>
                            </button>
                            <button class="icon-btn icon-btn-danger" onclick="deletePrestasi({{ $prestasi->id }})" title="Delete">
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
                    <td colspan="9">
                        <div class="empty-state">
                            <svg class="empty-state-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"></path>
                                <path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"></path>
                                <path d="M4 22h16"></path>
                                <path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"></path>
                                <path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"></path>
                                <path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"></path>
                            </svg>
                            <p>Belum ada data prestasi</p>
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
            <h3 class="modal-title">Upload File Prestasi</h3>
        </div>
        <form action="{{ route('admin.prestasi.upload') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
            @csrf
            <div class="file-upload-area" id="fileUploadArea">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto 16px; color: #a0aec0;">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="17 8 12 3 7 8"></polyline>
                    <line x1="12" y1="3" x2="12" y2="15"></line>
                </svg>
                <p style="color: #4a5568; margin-bottom: 8px; font-weight: 500;">Drag & drop file or click to browse</p>
                <p style="color: #a0aec0; font-size: 13px;">Supported formats: .xlsx, .xls, .csv</p>
                <input type="file" name="file" id="fileInput" accept=".xlsx,.xls,.csv" style="display: none;">
            </div>
            <div id="fileInfo" style="margin-bottom: 16px; padding: 12px; background: #edf2f7; border-radius: 8px; display: none;">
                <p style="font-size: 14px; color: #2d3748; font-weight: 500;" id="fileName"></p>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn btn-secondary" onclick="closeUploadModal()">Cancel</button>
                <button type="submit" class="btn btn-upload" id="uploadBtn" disabled>Upload</button>
            </div>
        </form>
    </div>
</div>

<div class="modal" id="editModal">
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
    function openEditModal(prestasi) {
        document.getElementById('editNama').value = prestasi.nama_mahasiswa;
        document.getElementById('editEmail').value = prestasi.email || '';
        document.getElementById('editNim').value = prestasi.nim || '';
        document.getElementById('editJenis').value = prestasi.jenis_prestasi || '';
        document.getElementById('editJurusan').value = prestasi.jurusan || '';
        document.getElementById('editTahun').value = prestasi.tahun || '';
        document.getElementById('editForm').action = `/admin/prestasi/${prestasi.id}`;
        document.getElementById('editModal').style.display = 'flex';
    }

    function closeEditModal() {
        document.getElementById('editModal').style.display = 'none';
    }

    function deletePrestasi(id) {
        if (confirm('Apakah Anda yakin ingin menghapus data prestasi ini?')) {
            fetch(`/admin/prestasi/${id}`, {
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
                alert('Terjadi kesalahan saat menghapus data prestasi.');
            });
        }
    }
</script>

@endsection