<script>
    // Search functionality
    document.getElementById('searchInput')?.addEventListener('keyup', function() {
        const searchValue = this.value.toLowerCase();
        const rows = document.querySelectorAll('#tableBody tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchValue) ? '' : 'none';
        });
    });

    // Upload Modal
    function openUploadModal() {
        const modal = document.getElementById('uploadModal');
        modal.classList.add('active');
        document.body.style.overflow = 'hidden'; // Prevent background scroll
    }

    function closeUploadModal() {
        const modal = document.getElementById('uploadModal');
        modal.classList.remove('active');
        document.getElementById('uploadForm').reset();
        document.getElementById('fileInfo').style.display = 'none';
        document.getElementById('uploadBtn').disabled = true;
        document.body.style.overflow = ''; // Restore scroll
    }

    // Close modal when clicking outside
    document.getElementById('uploadModal')?.addEventListener('click', function(e) {
        if (e.target === this) closeUploadModal();
    });

    // Close modal with ESC key
    document.addEventListener('keydown', function(e) {
        const modal = document.getElementById('uploadModal');
        if (e.key === 'Escape' && modal?.classList.contains('active')) {
            closeUploadModal();
        }
    });

    // File upload handling
    const fileUploadArea = document.getElementById('fileUploadArea');
    const fileInput = document.getElementById('fileInput');
    const uploadBtn = document.getElementById('uploadBtn');

    fileUploadArea?.addEventListener('click', () => fileInput.click());
    fileInput?.addEventListener('change', handleFile);

    // Drag and drop
    fileUploadArea?.addEventListener('dragover', (e) => {
        e.preventDefault();
        fileUploadArea.classList.add('drag-over');
    });

    fileUploadArea?.addEventListener('dragleave', () => {
        fileUploadArea.classList.remove('drag-over');
    });

    fileUploadArea?.addEventListener('drop', (e) => {
        e.preventDefault();
        fileUploadArea.classList.remove('drag-over');
        fileInput.files = e.dataTransfer.files;
        handleFile();
    });

    function handleFile() {
        if (fileInput.files.length > 0) {
            const file = fileInput.files[0];
            document.getElementById('fileName').textContent = file.name;
            document.getElementById('fileInfo').style.display = 'block';
            uploadBtn.disabled = false;
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const tableWrapper = document.querySelector('.table-wrapper');
        if (tableWrapper) {
            tableWrapper.addEventListener('scroll', function() {
                if (this.scrollLeft > 50) {
                    this.classList.add('scrolled');
                } else {
                    this.classList.remove('scrolled');
                }
            });
        }
    });

    function closeEditModal() {
        document.getElementById('editModal').style.display = 'none';
    }

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
                alert(data.message);
            }
        })
        .catch(err => {
            console.error(err);
            alert('Terjadi kesalahan saat update data.');
        });
    });

    window.onclick = function(event) {
        const editModal = document.getElementById('editModal');
        const uploadModal = document.getElementById('uploadModal');

        if (event.target === editModal) closeEditModal();
        if (event.target === uploadModal) closeUploadModal();
    };
</script>