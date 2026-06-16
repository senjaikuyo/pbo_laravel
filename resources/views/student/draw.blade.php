@extends('layouts/admin')

@push('title', 'Papan Gambar & Sketsa')

@push('addon-script-head')
<style>
    .draw-container {
        display: flex;
        flex-direction: row;
        gap: 20px;
        min-height: 650px;
    }

    @media (max-width: 992px) {
        .draw-container {
            flex-direction: column;
        }
    }

    /* Left Sidebar: Toolbox & Styling */
    .toolbox {
        flex: 0 0 280px;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        padding: 20px;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    /* Center Area: Canvas Workspace */
    .canvas-workspace {
        flex: 1;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .canvas-container {
        position: relative;
        width: 100%;
        max-width: 800px;
        background: #f8f9fc;
        border: 2px dashed #e3e6f0;
        border-radius: 8px;
        overflow: hidden;
        cursor: crosshair;
    }

    canvas {
        display: block;
        width: 100%;
        height: auto;
    }

    /* Template Cards Grid */
    .templates-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }

    .template-card {
        border: 2px solid #eaecf4;
        border-radius: 8px;
        padding: 10px;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s ease;
        background: #ffffff;
    }

    .template-card:hover, .template-card.active {
        border-color: #4e73df;
        background: #f8f9fc;
        transform: translateY(-2px);
    }

    .template-icon {
        font-size: 24px;
        color: #4e73df;
        margin-bottom: 5px;
    }

    .template-title {
        font-size: 12px;
        font-weight: 600;
        color: #5a5c69;
    }

    /* Color Swatch Circle */
    .color-palette {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 8px;
    }

    .color-swatch {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        cursor: pointer;
        border: 2px solid transparent;
        transition: all 0.2s ease;
        box-shadow: inset 0 0 4px rgba(0,0,0,0.1);
    }

    .color-swatch:hover, .color-swatch.active {
        transform: scale(1.15);
        border-color: #4e73df;
    }

    /* Tool Buttons Grid */
    .tools-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 8px;
    }

    .tool-btn {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 10px;
        border: 1px solid #eaecf4;
        background: #ffffff;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s ease;
        color: #858796;
    }

    .tool-btn:hover, .tool-btn.active {
        background: #4e73df;
        color: #ffffff;
        border-color: #4e73df;
    }

    .tool-btn i {
        font-size: 18px;
        margin-bottom: 4px;
    }

    .tool-btn span {
        font-size: 10px;
        font-weight: 600;
    }

    /* Styling Control inputs */
    .control-label {
        font-size: 12px;
        font-weight: 700;
        color: #4e73df;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
        display: block;
    }
</style>
@endpush

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Canvas & Papan Gambar Interaktif</h1>
    <div class="d-flex gap-2">
        <button id="undo-btn" class="btn btn-secondary btn-sm mr-2 shadow-sm">
            <i class="fas fa-undo mr-1"></i> Undo
        </button>
        <button id="redo-btn" class="btn btn-secondary btn-sm mr-2 shadow-sm">
            <i class="fas fa-redo mr-1"></i> Redo
        </button>
        <button id="clear-btn" class="btn btn-danger btn-sm mr-2 shadow-sm">
            <i class="fas fa-trash mr-1"></i> Bersihkan
        </button>
        <button id="export-btn" class="btn btn-success btn-sm shadow-sm">
            <i class="fas fa-download mr-1"></i> Ekspor PNG
        </button>
    </div>
</div>

<div class="draw-container mb-4">
    <!-- Left Sidebar Toolbox -->
    <div class="toolbox">
        <!-- Section: Templates -->
        <div>
            <span class="control-label">1. Pilih Template</span>
            <div class="templates-grid">
                <div class="template-card active" data-template="blank">
                    <div class="template-icon"><i class="fas fa-file"></i></div>
                    <div class="template-title">Kanvas Kosong</div>
                </div>
                <div class="template-card" data-template="student-card">
                    <div class="template-icon"><i class="fas fa-id-card"></i></div>
                    <div class="template-title">Desain Kartu</div>
                </div>
                <div class="template-card" data-template="wireframe">
                    <div class="template-icon"><i class="fas fa-columns"></i></div>
                    <div class="template-title">Wireframe</div>
                </div>
                <div class="template-card" data-template="mindmap">
                    <div class="template-icon"><i class="fas fa-project-diagram"></i></div>
                    <div class="template-title">Peta Pikiran</div>
                </div>
            </div>
        </div>

        <!-- Section: Drawing Tools -->
        <div>
            <span class="control-label">2. Alat Gambar</span>
            <div class="tools-grid">
                <div class="tool-btn active" data-tool="brush">
                    <i class="fas fa-paint-brush"></i>
                    <span>Kuas</span>
                </div>
                <div class="tool-btn" data-tool="eraser">
                    <i class="fas fa-eraser"></i>
                    <span>Penghapus</span>
                </div>
                <div class="tool-btn" data-tool="line">
                    <i class="fas fa-slash"></i>
                    <span>Garis</span>
                </div>
                <div class="tool-btn" data-tool="rect">
                    <i class="far fa-square"></i>
                    <span>Kotak</span>
                </div>
                <div class="tool-btn" data-tool="circle">
                    <i class="far fa-circle"></i>
                    <span>Lingkaran</span>
                </div>
                <div class="tool-btn" data-tool="text">
                    <i class="fas fa-font"></i>
                    <span>Teks</span>
                </div>
            </div>
        </div>

        <!-- Section: Stroke & Palette -->
        <div>
            <span class="control-label">3. Warna Kuas</span>
            <div class="color-palette mb-3">
                <div class="color-swatch active" style="background-color: #1e293b;" data-color="#1e293b"></div>
                <div class="color-swatch" style="background-color: #4e73df;" data-color="#4e73df"></div>
                <div class="color-swatch" style="background-color: #1cc88a;" data-color="#1cc88a"></div>
                <div class="color-swatch" style="background-color: #36b9cc;" data-color="#36b9cc"></div>
                <div class="color-swatch" style="background-color: #e74a3b;" data-color="#e74a3b"></div>
                <div class="color-swatch" style="background-color: #f6c23e;" data-color="#f6c23e"></div>
                <div class="color-swatch" style="background-color: #fd7e14;" data-color="#fd7e14"></div>
                <div class="color-swatch" style="background-color: #6f42c1;" data-color="#6f42c1"></div>
                <div class="color-swatch" style="background-color: #e83e8c;" data-color="#e83e8c"></div>
                <div class="color-swatch" style="background-color: #858796;" data-color="#858796"></div>
                <div class="color-swatch" style="background-color: #ffffff; border: 1px solid #ddd;" data-color="#ffffff"></div>
            </div>
            
            <div class="form-group mb-2">
                <label for="color-picker" class="small font-weight-bold text-gray-600">Warna Kustom:</label>
                <input type="color" id="color-picker" class="form-control form-control-sm" value="#1e293b" style="height: 38px;">
            </div>
        </div>

        <!-- Section: Stroke Configuration -->
        <div>
            <span class="control-label">4. Ukuran & Isi</span>
            <div class="form-group mb-3">
                <label for="brush-size" class="small font-weight-bold text-gray-600 d-flex justify-content-between">
                    <span>Ketebalan:</span>
                    <span id="brush-size-val">5px</span>
                </label>
                <input type="range" class="custom-range" id="brush-size" min="1" max="50" value="5">
            </div>

            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="fill-shape">
                <label class="custom-control-label small font-weight-bold text-gray-600" for="fill-shape">Isi Warna Bentuk</label>
            </div>
        </div>
    </div>

    <!-- Canvas Workspace Area -->
    <div class="canvas-workspace">
        <div class="canvas-container">
            <canvas id="main-canvas" width="800" height="500"></canvas>
        </div>
        <div class="small text-gray-500 mt-2">
            <i class="fas fa-info-circle mr-1"></i> Klik dan seret mouse untuk mulai menggambar. Klik di mana saja untuk menempatkan Teks saat mode Teks aktif.
        </div>
    </div>
</div>
@endsection

@push('addon-script-footer')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const canvas = document.getElementById("main-canvas");
        const ctx = canvas.getContext("2d");
        const brushSizeInput = document.getElementById("brush-size");
        const brushSizeVal = document.getElementById("brush-size-val");
        const colorPicker = document.getElementById("color-picker");
        const fillShapeCheckbox = document.getElementById("fill-shape");
        
        // Buttons
        const undoBtn = document.getElementById("undo-btn");
        const redoBtn = document.getElementById("redo-btn");
        const clearBtn = document.getElementById("clear-btn");
        const exportBtn = document.getElementById("export-btn");
        
        // Settings State
        let currentTool = "brush";
        let strokeColor = "#1e293b";
        let strokeWidth = 5;
        let fillShape = false;
        let selectedTemplate = "blank";
        
        // Drawing State
        let isDrawing = false;
        let startX, startY;
        let restorePoints = [];
        let redoPoints = [];
        let snapshot = null;

        // Init Canvas Background
        resetCanvasWithBackground();

        // Save initial blank state
        saveState();

        // 1. Tool Selection
        document.querySelectorAll(".tool-btn").forEach(btn => {
            btn.addEventListener("click", function () {
                document.querySelectorAll(".tool-btn").forEach(b => b.classList.remove("active"));
                this.classList.add("active");
                currentTool = this.dataset.tool;
            });
        });

        // 2. Color Selection
        document.querySelectorAll(".color-swatch").forEach(swatch => {
            swatch.addEventListener("click", function () {
                document.querySelectorAll(".color-swatch").forEach(s => s.classList.remove("active"));
                this.classList.add("active");
                strokeColor = this.dataset.color;
                colorPicker.value = strokeColor;
            });
        });

        colorPicker.addEventListener("input", function () {
            document.querySelectorAll(".color-swatch").forEach(s => s.classList.remove("active"));
            strokeColor = this.value;
        });

        // 3. Brush Size Selection
        brushSizeInput.addEventListener("input", function () {
            strokeWidth = this.value;
            brushSizeVal.textContent = strokeWidth + "px";
        });

        // 4. Fill checkbox
        fillShapeCheckbox.addEventListener("change", function () {
            fillShape = this.checked;
        });

        // 5. Template Selection
        document.querySelectorAll(".template-card").forEach(card => {
            card.addEventListener("click", function () {
                document.querySelectorAll(".template-card").forEach(c => c.classList.remove("active"));
                this.classList.add("active");
                selectedTemplate = this.dataset.template;
                
                if (confirm("Mengubah template akan menghapus gambar Anda saat ini. Lanjutkan?")) {
                    restorePoints = [];
                    redoPoints = [];
                    resetCanvasWithBackground();
                    saveState();
                }
            });
        });

        // 6. Draw functionality
        canvas.addEventListener("mousedown", startDrawing);
        canvas.addEventListener("mousemove", draw);
        canvas.addEventListener("mouseup", stopDrawing);
        canvas.addEventListener("mouseleave", stopDrawing);

        function startDrawing(e) {
            isDrawing = true;
            const pos = getMousePos(canvas, e);
            startX = pos.x;
            startY = pos.y;

            ctx.beginPath();
            ctx.lineWidth = strokeWidth;
            ctx.strokeStyle = strokeColor;
            ctx.fillStyle = strokeColor;
            ctx.lineCap = "round";
            ctx.lineJoin = "round";

            if (currentTool === "brush") {
                ctx.moveTo(startX, startY);
                ctx.lineTo(startX, startY);
                ctx.stroke();
            } else if (currentTool === "eraser") {
                ctx.strokeStyle = "#ffffff"; // Eraser behaves like white brush over templates
                ctx.moveTo(startX, startY);
                ctx.lineTo(startX, startY);
                ctx.stroke();
            } else if (currentTool === "text") {
                const text = prompt("Masukkan Teks:");
                if (text) {
                    ctx.font = `${strokeWidth * 3}px Nunito, sans-serif`;
                    ctx.fillText(text, startX, startY);
                    saveState();
                }
                isDrawing = false;
            }

            // Save visual snapshot to draw shapes correctly on drag
            snapshot = ctx.getImageData(0, 0, canvas.width, canvas.height);
        }

        function draw(e) {
            if (!isDrawing) return;
            const pos = getMousePos(canvas, e);
            const currentX = pos.x;
            const currentY = pos.y;

            if (currentTool === "brush") {
                ctx.strokeStyle = strokeColor;
                ctx.lineTo(currentX, currentY);
                ctx.stroke();
            } else if (currentTool === "eraser") {
                ctx.strokeStyle = "#ffffff";
                ctx.lineTo(currentX, currentY);
                ctx.stroke();
            } else {
                // Shapes: Line, Rectangle, Circle
                // Restore snapshot first so shape resets as drag moves
                ctx.putImageData(snapshot, 0, 0);
                ctx.lineWidth = strokeWidth;
                ctx.strokeStyle = strokeColor;
                ctx.fillStyle = strokeColor;

                if (currentTool === "line") {
                    ctx.beginPath();
                    ctx.moveTo(startX, startY);
                    ctx.lineTo(currentX, currentY);
                    ctx.stroke();
                } else if (currentTool === "rect") {
                    ctx.beginPath();
                    if (fillShape) {
                        ctx.fillRect(startX, startY, currentX - startX, currentY - startY);
                    } else {
                        ctx.strokeRect(startX, startY, currentX - startX, currentY - startY);
                    }
                } else if (currentTool === "circle") {
                    ctx.beginPath();
                    let radius = Math.sqrt(Math.pow(startX - currentX, 2) + Math.pow(startY - currentY, 2));
                    ctx.arc(startX, startY, radius, 0, 2 * Math.PI);
                    if (fillShape) {
                        ctx.fill();
                    } else {
                        ctx.stroke();
                    }
                }
            }
        }

        function stopDrawing() {
            if (isDrawing) {
                isDrawing = false;
                saveState();
            }
        }

        function getMousePos(canvasDom, mouseEvent) {
            const rect = canvasDom.getBoundingClientRect();
            // Scaling factors to translate CSS coordinates back to canvas bitmap pixels
            const scaleX = canvasDom.width / rect.width;
            const scaleY = canvasDom.height / rect.height;

            return {
                x: (mouseEvent.clientX - rect.left) * scaleX,
                y: (mouseEvent.clientY - rect.top) * scaleY
            };
        }

        // 7. Background Setup / Templates Data Dummy
        function resetCanvasWithBackground() {
            ctx.fillStyle = "#ffffff";
            ctx.fillRect(0, 0, canvas.width, canvas.height);

            if (selectedTemplate === "student-card") {
                // Card Border
                ctx.lineWidth = 3;
                ctx.strokeStyle = "#4e73df";
                ctx.strokeRect(50, 50, 700, 400);

                // Card Title Bar
                ctx.fillStyle = "#4e73df";
                ctx.fillRect(50, 50, 700, 80);

                ctx.fillStyle = "#ffffff";
                ctx.font = "bold 28px Nunito, sans-serif";
                ctx.fillText("KARTU IDENTITAS MAHASISWA", 80, 100);

                // Photo Area Outline
                ctx.strokeStyle = "#ccd1e4";
                ctx.strokeRect(100, 160, 180, 240);
                ctx.fillStyle = "#f8f9fc";
                ctx.fillRect(100, 160, 180, 240);

                ctx.fillStyle = "#858796";
                ctx.font = "14px Nunito, sans-serif";
                ctx.fillText("TEMPEL FOTO", 140, 280);

                // Info lines
                ctx.fillStyle = "#5a5c69";
                ctx.font = "bold 20px Nunito, sans-serif";
                ctx.fillText("NAMA     :", 320, 200);
                ctx.fillText("NIM      :", 320, 250);
                ctx.fillText("PRODI    :", 320, 300);

                ctx.strokeStyle = "#eaecf4";
                ctx.beginPath();
                ctx.moveTo(430, 205); ctx.lineTo(700, 205);
                ctx.moveTo(430, 255); ctx.lineTo(700, 255);
                ctx.moveTo(430, 305); ctx.lineTo(700, 305);
                ctx.stroke();

                // Signature Box
                ctx.strokeRect(520, 330, 180, 90);
                ctx.fillText("Tanda Tangan:", 520, 320);

            } else if (selectedTemplate === "wireframe") {
                // Header Panel
                ctx.fillStyle = "#eaecf4";
                ctx.fillRect(10, 10, 780, 60);
                ctx.fillStyle = "#5a5c69";
                ctx.font = "16px Nunito, sans-serif";
                ctx.fillText("[Header / Navigation Bar]", 300, 45);

                // Sidebar
                ctx.fillStyle = "#f8f9fc";
                ctx.fillRect(10, 80, 180, 410);
                ctx.strokeStyle = "#ccd1e4";
                ctx.strokeRect(10, 80, 180, 410);
                ctx.fillStyle = "#5a5c69";
                ctx.fillText("[Sidebar Menu]", 35, 120);

                // Content panels
                ctx.strokeStyle = "#ccd1e4";
                ctx.strokeRect(200, 80, 590, 410);

                ctx.fillStyle = "#f8f9fc";
                ctx.fillRect(220, 100, 260, 160);
                ctx.strokeRect(220, 100, 260, 160);
                ctx.fillStyle = "#5a5c69";
                ctx.fillText("[Panel A]", 320, 190);

                ctx.fillStyle = "#f8f9fc";
                ctx.fillRect(500, 100, 270, 160);
                ctx.strokeRect(500, 100, 270, 160);
                ctx.fillStyle = "#5a5c69";
                ctx.fillText("[Panel B]", 600, 190);

                ctx.strokeRect(220, 280, 550, 190);
                ctx.fillText("[Data Table / Dashboard Content Area]", 320, 380);

            } else if (selectedTemplate === "mindmap") {
                // Central Bubble
                ctx.strokeStyle = "#4e73df";
                ctx.lineWidth = 3;
                ctx.beginPath();
                ctx.arc(400, 250, 60, 0, 2 * Math.PI);
                ctx.stroke();
                ctx.fillStyle = "#5a5c69";
                ctx.font = "bold 16px Nunito, sans-serif";
                ctx.fillText("Topik Utama", 350, 255);

                // Branches
                ctx.strokeStyle = "#ccd1e4";
                ctx.lineWidth = 2;
                
                // Top Left
                ctx.beginPath(); ctx.moveTo(350, 210); ctx.lineTo(250, 130); ctx.stroke();
                ctx.strokeRect(170, 95, 120, 40);

                // Top Right
                ctx.beginPath(); ctx.moveTo(450, 210); ctx.lineTo(550, 130); ctx.stroke();
                ctx.strokeRect(510, 95, 120, 40);

                // Bottom Left
                ctx.beginPath(); ctx.moveTo(350, 290); ctx.lineTo(250, 370); ctx.stroke();
                ctx.strokeRect(170, 365, 120, 40);

                // Bottom Right
                ctx.beginPath(); ctx.moveTo(450, 290); ctx.lineTo(550, 370); ctx.stroke();
                ctx.strokeRect(510, 365, 120, 40);
            }
        }

        // Undo & Redo History management
        function saveState() {
            restorePoints.push(ctx.getImageData(0, 0, canvas.width, canvas.height));
            redoPoints = []; // Clear redo stack on new action
            
            // Limit history stack size
            if (restorePoints.length > 25) {
                restorePoints.shift();
            }
        }

        undoBtn.addEventListener("click", function () {
            if (restorePoints.length > 1) {
                const current = restorePoints.pop();
                redoPoints.push(current);
                const previous = restorePoints[restorePoints.length - 1];
                ctx.putImageData(previous, 0, 0);
            }
        });

        redoBtn.addEventListener("click", function () {
            if (redoPoints.length > 0) {
                const next = redoPoints.pop();
                restorePoints.push(next);
                ctx.putImageData(next, 0, 0);
            }
        });

        // Clear Canvas
        clearBtn.addEventListener("click", function () {
            if (confirm("Apakah Anda yakin ingin membersihkan seluruh kanvas?")) {
                restorePoints = [];
                redoPoints = [];
                resetCanvasWithBackground();
                saveState();
            }
        });

        // Export PNG
        exportBtn.addEventListener("click", function () {
            const dataUrl = canvas.toDataURL("image/png");
            const link = document.createElement("a");
            link.download = "sketsa-kanvas-" + Date.now() + ".png";
            link.href = dataUrl;
            link.click();
        });
    });
</script>
@endpush
