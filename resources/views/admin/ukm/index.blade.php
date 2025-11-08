@extends('layouts.admin')

@section('page-title', 'Dashboard UKM')

@include('partials.table-styles')

@section('content')
<div class="data-table-container">
    <div class="table-header">
        <h2 class="table-title">Daftar Anggota UKM</h2>
        <div class="table-actions">
            <div class="search-box">
                <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.35-4.35"></path>
                </svg>
                <input type="text" id="searchInput" placeholder="Search">
            </div>
            <div class="action-buttons">
                <a href="{{ route('admin.ukm.download-pdf') }}" class="btn btn-success">
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
                    <th>Nama UKM</th>
                    <th>Posisi</th>
                    <th>Tahun Bergabung</th>
                    <th>Jurusan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @forelse($ukms ?? [] as $ukm)
                <tr>
                    <td>
                        <div class="user-cell">
                            <div class="user-info-text">
                                <p>{{ $ukm->nama_mahasiswa }}</p>
                            </div>
                        </div>
                    </td>
                    <td data-label="Email">{{ $ukm->email ?? '-' }}</td>
                    <td data-label="NIM">{{ $ukm->nim ?? '-' }}</td>
                    <td data-label="Nama UKM">{{ $ukm->nama_ukm }}</td>
                    <td data-label="Posisi">
                        <span class="badge-posisi badge-{{ strtolower(str_replace(' ', '', $ukm->posisi ?? 'anggota')) }}">
                            {{ ucfirst($ukm->posisi ?? 'Anggota') }}
                        </span>
                    </td>
                    <td data-label="Tahun Bergabung">{{ $ukm->tahun_bergabung ?? '-' }}</td>
                    <td data-label="Jurusan">{{ $ukm->jurusan ?? '-' }}</td>
                    <td data-label="Action">
                        <div class="action-icons">
                            <button class="icon-btn icon-btn-success" onclick="openEditModal({{ $ukm->toJson() }})" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"></path>
                                </svg>
                            </button>
                            <button class="icon-btn icon-btn-danger" onclick="deleteUkm({{ $ukm->id }})" title="Delete">
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
                    <td colspan="8">
                        <div class="empty-state">
                            <svg class="empty-state-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            <p>Belum ada data UKM</p>
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
            <h3 class="modal-title">Upload File UKM</h3>
        </div>
        <form action="{{ route('admin.ukm.upload') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
            @csrf
            <div style="margin-bottom: 20px; padding: 16px; background: #e6fffa; border-radius: 8px; border-left: 4px solid #38b2ac;">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#38b2ac" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="16" x2="12" y2="12"></line>
                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                    </svg>
                    <div style="flex: 1;">
                        <p style="color: #234e52; font-weight: 600; margin-bottom: 4px; font-size: 14px;">Belum punya template?</p>
                        <p style="color: #234e52; font-size: 13px; margin-bottom: 8px;">Download template Excel terlebih dahulu untuk memudahkan upload data.</p>
                        <a href="{{ route('admin.ukm.download-template') }}" class="btn btn-secondary" style="padding: 8px 16px; font-size: 13px; display: inline-flex; align-items: center; gap: 8px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="7 10 12 15 17 10"></polyline>
                                <line x1="12" y1="15" x2="12" y2="3"></line>
                            </svg>
                            Download Template Excel
                        </a>
                    </div>
                </div>
            </div>

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

<div class="modal-edit" id="editModal">
    <div class="modal-content" style="max-width: 600px;">
        <div class="modal-header">
            <h3 class="modal-title">Edit Data UKM</h3>
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
                    <label>Nama UKM</label>
                    <input type="text" name="nama_ukm" id="editNamaUkm" class="form-control" required>
                </div>

                <div class="form-group" style="margin-bottom: 12px;">
                    <label>Posisi / Jabatan</label>
                    <input type="text" name="posisi" id="editPosisi" class="form-control" placeholder="Contoh: Ketua / Anggota / Sekretaris">
                </div>

                <div class="form-group" style="margin-bottom: 12px;">
                    <label>Tahun Bergabung</label>
                    <input type="text" name="tahun_bergabung" id="editTahunBergabung" class="form-control" placeholder="Contoh: 2023">
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label>Jurusan</label>
                    <input type="text" name="jurusan" id="editJurusan" class="form-control">
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
    function openEditModal(ukm) {
        document.getElementById('editNama').value = ukm.nama_mahasiswa || '';
        document.getElementById('editEmail').value = ukm.email || '';
        document.getElementById('editNim').value = ukm.nim || '';
        document.getElementById('editNamaUkm').value = ukm.nama_ukm || '';
        document.getElementById('editPosisi').value = ukm.posisi || '';
        document.getElementById('editTahunBergabung').value = ukm.tahun_bergabung || '';
        document.getElementById('editJurusan').value = ukm.jurusan || '';

        document.getElementById('editForm').action = `/admin/ukm/${ukm.id}`;
        document.getElementById('editModal').style.display = 'flex';
    }

    function closeEditModal() {
        document.getElementById('editModal').style.display = 'none';
    }

    function deleteUkm(id) {
        if (confirm('Apakah Anda yakin ingin menghapus data UKM ini?')) {
            fetch(`/admin/ukm/${id}`, {
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
                alert('Terjadi kesalahan saat menghapus data UKM.');
            });
        }
    }
</script>

@endsection