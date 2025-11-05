<style>
    html, body {
        height: auto !important;
        overflow-y: auto !important;
    }

    .main-content,
    .page-wrapper,
    .content-wrapper {
        height: auto !important;
        min-height: 100vh !important;
        overflow-y: visible !important;
    }

    .data-table-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .table-header {
        padding: 24px;
        border-bottom: 1px solid #e2e8f0;
    }

    .table-title {
        font-size: 18px;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 16px;
    }

    .table-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        align-items: center;
    }

    .search-box {
        flex: 1;
        min-width: 250px;
        position: relative;
    }

    .search-box input {
        width: 100%;
        padding: 10px 16px 10px 40px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 14px;
        outline: none;
        transition: border-color 0.2s;
    }

    .search-box input:focus {
        border-color: #348439;
    }

    .search-icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #a0aec0;
    }

    .action-buttons {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        white-space: nowrap;
    }

    .btn-success {
        background: #43A047;
        color: white;
    }

    .btn-success:hover {
        background: #2E7D32;
    }

    .btn-upload {
        background: #2196F3;
        color: white;
    }

    .btn-upload:hover {
        background: #1976D2;
    }

    .btn-secondary {
        background: #e2e8f0;
        color: #4a5568;
    }

    .btn-secondary:hover {
        background: #cbd5e0;
    }

    .table-wrapper {
        width: 100%;
        overflow-x: auto;
        overflow-y: visible;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: thin;
        scrollbar-color: rgba(0,0,0,0.3) #f1f1f1;
    }

    .table-wrapper table {
        width: 100%;
        border-collapse: collapse;
        table-layout: auto;
        word-wrap: break-word;
        white-space: normal;
    }

    .table-wrapper th,
    .table-wrapper td {
        text-align: left;
        vertical-align: top;
        padding: 8px;
        border: 1px solid #ddd;
        word-break: break-word;
    }

    .table-wrapper th,
    .table-wrapper td {
        font-size: 12px;
    }

    .table-wrapper::-webkit-scrollbar {
        height: 10px;
    }

    .table-wrapper::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .table-wrapper::-webkit-scrollbar-thumb {
        background: rgba(0, 0, 0, 0.3);
        border-radius: 10px;
    }

    .table-wrapper::-webkit-scrollbar-thumb:hover {
        background: rgba(0, 0, 0, 0.5);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        min-width: 900px;
    }

    thead {
        background: #f7fafc;
    }

    th {
        padding: 16px;
        text-align: left;
        font-size: 12px;
        font-weight: 600;
        color: #718096;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 1px solid #e2e8f0;
        white-space: nowrap;
    }

    td {
        padding: 16px;
        font-size: 14px;
        color: #4a5568;
        border-bottom: 1px solid #e2e8f0;
        white-space: nowrap;
    }

    tbody tr:hover {
        background: #f7fafc;
    }

    .user-cell {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 200px;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        flex-shrink: 0;
    }

    .user-info-text {
        min-width: 0;
        flex: 1;
    }

    .user-info-text p {
        font-size: 12px;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 0;
        white-space: nowrap;
    }

    .badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 500;
        white-space: nowrap;
    }

    .badge-email {
        background: #e6fffa;
        color: #234e52;
    }

    .badge-tingkat {
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    .badge-nasional {
        background: #fef5e7;
        color: #744210;
    }

    .badge-internasional {
        background: #e3f2fd;
        color: #1565c0;
    }

    .badge-lokal {
        background: #f0fdf4;
        color: #14532d;
    }

    .badge-posisi {
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    .badge-ketua {
        background: #fef5e7;
        color: #744210;
    }

    .badge-wakil {
        background: #e3f2fd;
        color: #1565c0;
    }

    .badge-sekretaris {
        background: #f3e5f5;
        color: #4a148c;
    }

    .badge-bendahara {
        background: #fff3e0;
        color: #e65100;
    }

    .badge-anggota {
        background: #f0fdf4;
        color: #14532d;
    }

    .action-icons {
        display: flex;
        justify-content: center;
        gap: 4px;
    }

    .icon-btn {
        width: 32px;
        height: 32px;
        border: none;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
        flex-shrink: 0;
    }

    .icon-btn-success {
        background: #c6f6d5;
        color: #22543d;
    }

    .icon-btn-success:hover {
        background: #9ae6b4;
    }

    .icon-btn-danger {
        background: #fed7d7;
        color: #742a2a;
    }

    .icon-btn-danger:hover {
        background: #fc8181;
    }

    .empty-state {
        padding: 60px 24px;
        text-align: center;
        color: #a0aec0;
    }

    .empty-state-icon {
        width: 64px;
        height: 64px;
        margin: 0 auto 16px;
        opacity: 0.5;
    }

    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 2000;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }

    .modal.active {
        display: flex;
    }

    .modal .modal-content {
        background: white;
        border-radius: 12px;
        padding: 32px;
        max-width: 500px;
        width: 100%;
        max-height: 90vh;
        overflow-y: auto;
    }

    .modal .modal-header {
        margin-bottom: 24px;
    }

    .modal .modal-title {
        font-size: 20px;
        font-weight: 600;
        color: #2d3748;
    }

    .modal .file-upload-area {
        border: 2px dashed #cbd5e0;
        border-radius: 8px;
        padding: 32px;
        text-align: center;
        margin-bottom: 16px;
        cursor: pointer;
        transition: border-color 0.2s;
    }

    .modal .file-upload-area:hover {
        border-color: #2196F3;
    }

    .modal .file-upload-area.drag-over {
        border-color: #2196F3;
        background: #edf2f7;
    }

    .modal .modal-actions {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
        flex-wrap: wrap;
    }

    /* ========== MODAL EDIT STYLES (ADVANCED VERSION) ========== */
    .modal-edit {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(4px);
        z-index: 2000;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        animation: modalFadeIn 0.3s ease;
    }

    @keyframes modalFadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    .modal-edit.active {
        display: flex;
    }

    .modal-edit .modal-content {
        background: rgba(255, 255, 255, 0.98);
        border-radius: 20px;
        max-width: 600px;
        width: 100%;
        max-height: 90vh;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        animation: modalSlideUp 0.4s ease;
        display: flex;
        flex-direction: column;
    }

    @keyframes modalSlideUp {
        from {
            transform: translateY(50px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .modal-edit .modal-header {
        background: linear-gradient(135deg, #43A047 0%, #2E7D32 100%);
        padding: 30px 32px;
        position: relative;
        overflow: hidden;
    }

    .modal-edit .modal-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .modal-edit .modal-header::after {
        content: '✏️';
        position: absolute;
        top: 20px;
        right: 30px;
        font-size: 40px;
        opacity: 0.2;
    }

    .modal-edit .modal-title {
        font-size: 24px;
        font-weight: 600;
        color: white;
        margin: 0;
        position: relative;
        z-index: 1;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .modal-edit .modal-body {
        padding: 32px;
        overflow-y: auto;
        flex: 1;
    }

    .modal-edit .modal-body::-webkit-scrollbar {
        width: 8px;
    }

    .modal-edit .modal-body::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .modal-edit .modal-body::-webkit-scrollbar-thumb {
        background: #cbd5e0;
        border-radius: 10px;
    }

    .modal-edit .modal-body::-webkit-scrollbar-thumb:hover {
        background: #a0aec0;
    }

    .modal-edit .form-group {
        margin-bottom: 24px;
        position: relative;
    }

    .modal-edit .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #4a5568;
        font-weight: 500;
        font-size: 14px;
        transition: color 0.3s ease;
    }

    .modal-edit .form-group:focus-within label {
        color: #43A047;
    }

    .modal-edit .form-control {
        width: 100%;
        padding: 14px 16px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 15px;
        transition: all 0.3s ease;
        background: #f7fafc;
        color: #2d3748;
        font-family: inherit;
    }

    .modal-edit .form-control:focus {
        outline: none;
        border-color: #43A047;
        background: white;
        box-shadow: 0 0 0 4px rgba(67, 160, 71, 0.1);
        transform: translateY(-2px);
    }

    .modal-edit .form-control:hover {
        border-color: #cbd5e0;
    }

    .modal-edit .form-control::placeholder {
        color: #a0aec0;
    }

    .modal-edit .modal-actions {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
        flex-wrap: wrap;
        padding: 24px 32px;
        background: #f8f9fa;
        border-top: 1px solid #e2e8f0;
    }

    .modal-edit .modal-actions .btn {
        padding: 13px 28px;
        border: none;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .modal-edit .modal-actions .btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .modal-edit .modal-actions .btn:active::before {
        width: 300px;
        height: 300px;
    }

    .modal-edit .modal-actions .btn-secondary {
        background: #e2e8f0;
        color: #4a5568;
    }

    .modal-edit .modal-actions .btn-secondary:hover {
        background: #cbd5e0;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .modal-edit .modal-actions .btn-success {
        background: linear-gradient(135deg, #43A047 0%, #2E7D32 100%);
        color: white;
    }

    .modal-edit .modal-actions .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(67, 160, 71, 0.4);
    }

    /* Input animation */
    @keyframes inputFocus {
        0% { transform: scale(1); }
        50% { transform: scale(1.02); }
        100% { transform: scale(1); }
    }

    .modal-edit .form-control:focus {
        animation: inputFocus 0.3s ease;
    }

    /* ========== TABLET & MOBILE RESPONSIVE ========== */

    /* Tablet (768px - 1024px) */
    @media (max-width: 1024px) {
        .table-header {
            padding: 20px;
        }

        .table-title {
            font-size: 16px;
            margin-bottom: 12px;
        }

        table {
            min-width: 850px;
        }

        th, td {
            padding: 12px 10px;
            font-size: 13px;
        }

        .user-cell {
            min-width: 180px;
        }

        /* Modal Edit Tablet */
        .modal-edit .modal-content {
            max-width: 90%;
        }

        .modal-edit .modal-header {
            padding: 25px 28px;
        }

        .modal-edit .modal-title {
            font-size: 22px;
        }

        .modal-edit .modal-body {
            padding: 28px 24px;
        }

        .modal-edit .modal-actions {
            padding: 20px 24px;
        }
    }

    /* Mobile (max-width: 768px) */
    @media (max-width: 768px) {
        .data-table-container {
            border-radius: 8px;
            margin: 0 -8px;
        }

        .table-header {
            padding: 16px;
        }

        .table-title {
            font-size: 16px;
            margin-bottom: 12px;
        }

        .table-actions {
            flex-direction: column;
            gap: 10px;
        }

        .search-box {
            width: 100%;
            min-width: auto;
        }

        .search-box input {
            padding: 10px 12px 10px 36px;
            font-size: 14px;
        }

        .action-buttons {
            width: 100%;
            flex-direction: row;
            gap: 8px;
        }

        .btn {
            flex: 1;
            justify-content: center;
            padding: 10px 12px;
            font-size: 13px;
        }

        .btn svg {
            width: 14px;
            height: 14px;
        }

        .table-wrapper {
            overflow-x: auto !important;
            -webkit-overflow-scrolling: touch;
            padding-bottom: 8px;
        }

        table {
            min-width: 800px;
            font-size: 13px;
        }

        th {
            padding: 12px 10px;
            font-size: 11px;
        }

        td {
            padding: 12px 10px;
            font-size: 13px;
        }

        .user-cell {
            min-width: 160px;
            gap: 10px;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
        }

        .user-info-text h4 {
            font-size: 13px;
        }

        .badge {
            padding: 3px 10px;
            font-size: 11px;
        }

        .badge-tingkat,
        .badge-posisi {
            padding: 4px 10px;
            font-size: 11px;
        }

        .action-icons {
            gap: 6px;
        }

        .icon-btn {
            width: 30px;
            height: 30px;
        }

        .icon-btn svg {
            width: 14px;
            height: 14px;
        }

        /* Modal Upload Mobile */
        .modal {
            padding: 0;
            align-items: flex-end;
        }

        .modal .modal-content {
            max-width: 100%;
            border-radius: 16px 16px 0 0;
            max-height: 85vh;
            padding: 24px 20px;
        }

        .modal .modal-title {
            font-size: 18px;
        }

        .modal .file-upload-area {
            padding: 24px 16px;
        }

        .modal .modal-actions {
            flex-direction: column-reverse;
            gap: 8px;
        }

        .modal .modal-actions .btn {
            width: 100%;
        }

        /* Modal Edit Mobile */
        .modal-edit {
            padding: 0;
            align-items: flex-end;
        }

        .modal-edit .modal-content {
            max-width: 100%;
            border-radius: 20px 20px 0 0;
            max-height: 85vh;
        }

        .modal-edit .modal-header {
            padding: 24px 20px;
            border-radius: 20px 20px 0 0;
        }

        .modal-edit .modal-title {
            font-size: 20px;
        }

        .modal-edit .modal-header::after {
            font-size: 32px;
            top: 18px;
            right: 20px;
        }

        .modal-edit .modal-body {
            padding: 24px 20px;
        }

        .modal-edit .form-group {
            margin-bottom: 20px;
        }

        .modal-edit .form-group label {
            font-size: 13px;
        }

        .modal-edit .form-control {
            padding: 12px 14px;
            font-size: 14px;
        }

        .modal-edit .modal-actions {
            flex-direction: column-reverse;
            gap: 10px;
            padding: 20px;
        }

        .modal-edit .modal-actions .btn {
            width: 100%;
            justify-content: center;
            padding: 12px 24px;
            font-size: 14px;
        }
    }

    /* Small Mobile (max-width: 480px) */
    @media (max-width: 480px) {
        .data-table-container {
            margin: 0 -12px;
        }

        .table-header {
            padding: 14px;
        }

        .table-title {
            font-size: 15px;
        }

        .search-box input {
            padding: 9px 12px 9px 34px;
            font-size: 13px;
        }

        .btn {
            padding: 9px 10px;
            font-size: 12px;
        }

        table {
            min-width: 750px;
            font-size: 12px;
        }

        th {
            padding: 10px 8px;
            font-size: 10px;
        }

        td {
            padding: 10px 8px;
            font-size: 12px;
        }

        .user-cell {
            min-width: 140px;
            gap: 8px;
        }

        .user-avatar {
            width: 32px;
            height: 32px;
        }

        .user-info-text h4 {
            font-size: 12px;
        }

        .badge {
            padding: 2px 8px;
            font-size: 10px;
        }

        .badge-tingkat,
        .badge-posisi {
            padding: 3px 8px;
            font-size: 10px;
        }

        .icon-btn {
            width: 28px;
            height: 28px;
        }

        .icon-btn svg {
            width: 13px;
            height: 13px;
        }

        /* Modal Edit Small Mobile */
        .modal-edit .modal-content {
            border-radius: 16px 16px 0 0;
        }

        .modal-edit .modal-header {
            padding: 20px 16px;
            border-radius: 16px 16px 0 0;
        }

        .modal-edit .modal-title {
            font-size: 18px;
        }

        .modal-edit .modal-header::after {
            font-size: 28px;
            top: 16px;
            right: 16px;
        }

        .modal-edit .modal-body {
            padding: 20px 16px;
        }

        .modal-edit .form-group {
            margin-bottom: 18px;
        }

        .modal-edit .form-group label {
            font-size: 12px;
            margin-bottom: 6px;
        }

        .modal-edit .form-control {
            padding: 11px 13px;
            font-size: 13px;
        }

        .modal-edit .modal-actions {
            padding: 16px;
        }

        .modal-edit .modal-actions .btn {
            padding: 11px 20px;
            font-size: 13px;
        }
    }

    /* Very Small Mobile (max-width: 360px) */
    @media (max-width: 360px) {
        table {
            min-width: 700px;
        }

        th {
            padding: 8px 6px;
            font-size: 9px;
        }

        td {
            padding: 8px 6px;
            font-size: 11px;
        }

        .user-cell {
            min-width: 130px;
        }

        .user-avatar {
            width: 28px;
            height: 28px;
        }

        .user-info-text h4 {
            font-size: 11px;
        }

        .badge {
            font-size: 9px;
            padding: 2px 6px;
        }

        .icon-btn {
            width: 26px;
            height: 26px;
        }

        .icon-btn svg {
            width: 12px;
            height: 12px;
        }

        /* Modal Edit Very Small Mobile */
        .modal-edit .modal-header {
            padding: 18px 14px;
        }

        .modal-edit .modal-title {
            font-size: 17px;
        }

        .modal-edit .modal-body {
            padding: 18px 14px;
        }

        .modal-edit .form-control {
            padding: 10px 12px;
            font-size: 13px;
        }

        .modal-edit .modal-actions {
            padding: 14px;
        }

        .modal-edit .modal-actions .btn {
            padding: 10px 18px;
            font-size: 12px;
        }
    }

    /* Landscape orientation */
    @media (max-height: 500px) and (orientation: landscape) {
        .modal .modal-content {
            max-height: 95vh;
            padding: 20px;
        }

        .modal .file-upload-area {
            padding: 20px;
        }

        .modal .modal-actions {
            flex-direction: row;
        }

        .modal-edit {
            align-items: center;
        }

        .modal-edit .modal-content {
            max-height: 95vh;
            border-radius: 16px;
        }

        .modal-edit .modal-header {
            padding: 20px 24px;
        }

        .modal-edit .modal-body {
            padding: 20px 24px;
        }

        .modal-edit .modal-actions {
            flex-direction: row;
            padding: 16px 24px;
        }

        .modal-edit .modal-actions .btn {
            width: auto;
        }
    }

    /* iOS Safari smooth scrolling */
    @supports (-webkit-touch-callout: none) {
        .table-wrapper,
        .modal .modal-content,
        .modal-edit .modal-body {
            -webkit-overflow-scrolling: touch;
        }
    }

    /* Ensure modals are always scrollable */
    .modal-edit .modal-body {
        overflow-y: auto !important;
        max-height: calc(90vh - 200px);
    }

    @media (max-width: 768px) {
        .modal-edit .modal-body {
            max-height: calc(85vh - 180px);
        }
    }

    /* Firefox scrollbar for modal-edit */
    .modal-edit .modal-body {
        scrollbar-width: thin;
        scrollbar-color: #cbd5e0 #f1f5f9;
    }
</style>