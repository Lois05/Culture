@extends('layouts.layout_front')

@section('title', 'Contribuer - Documenter la culture du Bénin')

@section('content')
<main class="contribute-page">
    <header class="contribute-hero">
        <div class="container hero-inner">
            <div class="hero-left">
                <h1>Contribuez à la mémoire culturelle du Bénin</h1>
                <p class="subtitle">Partagez un texte, une photo, une vidéo ou une audio. Merci de documenter les traditions, langues et savoir-faire locaux.</p>
                <div class="hero-stats">
                    <div class="stat">
                        <div class="stat-number" data-target="{{ $stats['total_contents'] ?? 150 }}">0</div>
                        <div class="stat-label">Contenus publiés</div>
                    </div>
                    <div class="stat">
                        <div class="stat-number" data-target="{{ $stats['total_contributors'] ?? 45 }}">0</div>
                        <div class="stat-label">Contributeurs</div>
                    </div>
                </div>
            </div>

            <div class="hero-right">
                <div class="guidelines-card" aria-hidden="false">
                    <h3>Guide rapide</h3>
                    <ul>
                        <li><strong>Clair & authentique</strong> — décrivez la source et la signification.</li>
                        <li><strong>Respect</strong> — pas d’images offensantes.</li>
                        <li><strong>Médias</strong> — JPG/PNG/MP4/MP3 acceptés (max 10MB / fichier).</li>
                    </ul>
                    <a href="#formSection" class="btn btn-primary">Commencer ma contribution</a>
                </div>
            </div>
        </div>
        <div class="hero-decor"></div>
    </header>

    <section id="formSection" class="contribution-form">
        <div class="container">
            <form id="contributionForm" action="{{ route('contribute.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf

                <!-- Progress -->
                <div class="form-progress" aria-hidden="false">
                    <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-fill" style="width: 0%;"></div>
                    </div>

                    <div class="progress-steps" aria-hidden="false">
                        <button type="button" class="step active" data-step="1">1. Infos</button>
                        <button type="button" class="step" data-step="2">2. Médias</button>
                        <button type="button" class="step" data-step="3">3. Finaliser</button>
                    </div>
                </div>

                <div class="form-steps">

                    <!-- STEP 1: Basic Info -->
                    <section class="form-step active" data-step="1" aria-labelledby="step1Title">
                        <div class="form-grid">
                            <div class="field">
                                <label for="titre">Titre <span aria-hidden="true">*</span></label>
                                <input id="titre" name="titre" class="form-input" required placeholder="Titre du contenu (ex : La danse X)"/>
                                <small class="hint">Un titre court et évocateur.</small>
                            </div>

                            <div class="field">
                                <label for="id_region">Région <span aria-hidden="true">*</span></label>
                                <select id="id_region" name="id_region" class="modern-select" required>
                                    <option value="">Choisir une région</option>
                                    @foreach(\App\Models\Region::all() as $r)
                                        <option value="{{ $r->id_region }}">{{ $r->nom_region }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="field">
                                <label for="id_type_contenu">Type de contenu</label>
                                <select id="id_type_contenu" name="id_type_contenu" class="modern-select">
                                    <option value="">Article</option>
                                    @foreach(\App\Models\TypeContenu::all() as $t)
                                        <option value="{{ $t->id_type_contenu }}">{{ $t->nom_contenu }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="field">
                                <label for="id_langue">Langue</label>
                                <select id="id_langue" name="id_langue" class="modern-select">
                                    <option value="">Français</option>
                                    @foreach(\App\Models\Langue::all() as $l)
                                        <option value="{{ $l->id_langue }}">{{ $l->nom_langue }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="field full">
                                <label for="texte">Texte / Description <span aria-hidden="true">*</span></label>
                                <textarea id="texte" name="texte" class="form-textarea" rows="8" required placeholder="Racontez la tradition, son usage, son histoire..."></textarea>
                                <small class="hint">Ajoute une source si possible (personne, lieu, année).</small>
                            </div>
                        </div>

                        <div class="step-actions">
                            <div>
                                <button type="button" class="btn btn-prev" aria-label="Précédent" disabled>Précédent</button>
                            </div>
                            <div>
                                <button type="button" class="btn btn-next" data-next="2">Suivant →</button>
                            </div>
                        </div>
                    </section>

                    <!-- STEP 2: Médias -->
                    <section class="form-step" data-step="2" aria-labelledby="step2Title">
                        <div class="form-grid">
                            <div class="field full">
                                <label>Zone d’upload (images, vidéos, audios)</label>
                                <div id="uploadZone" class="upload-zone" aria-describedby="uploadHint">
                                    <input type="file" name="medias[]" class="file-input" multiple accept="image/*,video/*,audio/*" />
                                    <div class="upload-message">
                                        <strong>Glisse & dépose</strong> ou cliquez pour sélectionner.<br>
                                        <small id="uploadHint">Max 10MB par fichier • JPG, PNG, MP4, MP3</small>
                                    </div>
                                </div>
                                <div id="mediaPreview" class="media-preview" aria-live="polite"></div>
                            </div>

                            <div class="field">
                                <label for="credit">Crédit / Source</label>
                                <input id="credit" name="credit" class="form-input" placeholder="Nom du contributeur ou de la source"/>
                                <small class="hint">Ex : Marie D. / Archive familiale</small>
                            </div>

                            <div class="field">
                                <label for="mots_cles">Mots-clés</label>
                                <input id="mots_cles" name="mots_cles" class="form-input" placeholder="séparez par des virgules: danse,marche,fon"/>
                            </div>
                        </div>

                        <div class="step-actions">
                            <div>
                                <button type="button" class="btn btn-prev" data-prev="1">← Précédent</button>
                            </div>
                            <div>
                                <button type="button" class="btn btn-next" data-next="3">Suivant →</button>
                            </div>
                        </div>
                    </section>

                    <!-- STEP 3: Final -->
                    <section class="form-step" data-step="3" aria-labelledby="step3Title">
                        <div class="form-grid">
                            <div class="field full">
                                <label for="consent">Consentement</label>
                                <div class="consent-box">
                                    <input id="consent" type="checkbox" name="consent" required/>
                                    <label for="consent">Je confirme que j'ai le droit de partager ces contenus et que je respecte les personnes évoquées.</label>
                                </div>
                            </div>

                            <div class="field">
                                <label for="visibility">Visibilité</label>
                                <select id="visibility" name="visibility" class="modern-select">
                                    <option value="public">Public (visible par tous)</option>
                                    <option value="private">Privé (brouillon)</option>
                                </select>
                            </div>

                            <div class="field">
                                <label for="captcha">Vérification</label>
                                <input id="captcha" name="captcha" class="form-input" placeholder="Tapez 'BENIN' pour continuer" />
                            </div>
                        </div>

                        <div class="step-actions">
                            <div>
                                <button type="button" class="btn btn-prev" data-prev="2">← Précédent</button>
                            </div>
                            <div class="submit-buttons">
                                <button type="button" class="btn btn-draft" id="saveDraft">Enregistrer comme brouillon</button>
                                <button type="submit" class="btn btn-submit">Publier</button>
                            </div>
                        </div>
                    </section>
                </div>
            </form>
        </div>
    </section>

    <section class="guidelines-modern">
        <div class="container">
            <div class="guidelines-header">
                <h2>Conseils pour une contribution exceptionnelle</h2>
                <p>Suivez ces bonnes pratiques pour que votre contenu soit accepté et mis en valeur.</p>
            </div>

            <div class="guidelines-grid">
                <div class="guideline-card">
                    <div class="guideline-icon">📸</div>
                    <h3>Photos nettes</h3>
                    <p>Privilégiez des images claires, bien cadrées et légendées (qui, quoi, où, quand).</p>
                </div>

                <div class="guideline-card">
                    <div class="guideline-icon">🗣️</div>
                    <h3>Contexte</h3>
                    <p>Expliquez l'origine, la signification et les personnes impliquées.</p>
                </div>

                <div class="guideline-card">
                    <div class="guideline-icon">🔒</div>
                    <h3>Respectez la vie privée</h3>
                    <p>Évitez de publier sans consentement. Utilisez des flous si nécessaire.</p>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@push('styles')
<style>
    /* Variables (peut être redéfini globalement dans ton layout) */
    :root{
        --primary: #e17000; /* orange béninois */
        --primary-dark: #b85400;
        --secondary: #1abc9c; /* vert/teal */
        --accent: #6c5ce7;
        --light: #f7f9fb;
        --dark: #15202b;
        --dark-light: #3a4752;
        --gray: #6c757d;
        --gray-light: #e9ecef;
        --glass: rgba(255,255,255,0.06);
        --glass-border: rgba(255,255,255,0.08);
        --shadow: 0 6px 18px rgba(16,24,40,0.06);
        --shadow-lg: 0 20px 40px rgba(16,24,40,0.12);
        --transition: all 0.28s cubic-bezier(.2,.9,.3,1);
        font-family: 'Inter', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
    }

    /* Layout */
    .container { max-width: 1100px; margin: 0 auto; padding: 0 1rem; }

    /* HERO */
    .contribute-hero { background: linear-gradient(135deg, rgba(225,112,0,0.95), rgba(26,188,156,0.95)); color: white; padding: 4rem 0; position: relative; overflow: hidden; border-bottom-left-radius: 24px; border-bottom-right-radius: 24px;}
    .hero-inner { display: grid; grid-template-columns: 1fr 380px; gap: 2rem; align-items: center; }
    .hero-left h1 { font-size: 2.2rem; margin: 0 0 0.6rem; font-weight: 800; letter-spacing: -0.02em; }
    .hero-left .subtitle { opacity: 0.95; margin-bottom: 1.25rem; }
    .hero-stats { display:flex; gap: 1.2rem; margin-top: 1rem; }
    .stat { background: rgba(255,255,255,0.08); padding: 0.7rem 1rem; border-radius: 12px; text-align:center; min-width:110px; }
    .stat-number { font-size:1.4rem; font-weight:800; color: white; }
    .stat-label { font-size:0.85rem; color: white; opacity:0.95; }

    .hero-right { display:flex; align-items:center; justify-content:center; }
    .guidelines-card { background: rgba(255,255,255,0.08); padding: 1.25rem; border-radius: 14px; width:100%; box-shadow: var(--shadow); border:1px solid rgba(255,255,255,0.06); }
    .guidelines-card h3 { margin:0 0 0.5rem; }
    .guidelines-card ul { margin:0; padding-left:1rem; font-size:0.95rem;}
    .guidelines-card .btn { margin-top:1rem; display:inline-block; }

    .hero-decor { position:absolute; right:-80px; top:-40px; width:420px; height:420px; background: radial-gradient(circle at 30% 20%, rgba(255,255,255,0.06), transparent 30%); transform: rotate(12deg); opacity:0.4; pointer-events:none; }

    /* FORM */
    .contribution-form { padding: 3rem 0; background: var(--light); }
    .form-progress { margin-bottom: 1.2rem; display:flex; flex-direction:column; gap:0.8rem; }
    .progress-bar { height: 10px; background: var(--gray-light); border-radius: 999px; overflow:hidden; }
    .progress-fill { height:100%; width:0%; background: linear-gradient(90deg,var(--primary),var(--accent)); transition: width 450ms ease; }

    .progress-steps { display:flex; gap:0.5rem; align-items:center; }
    .progress-steps .step { background:transparent; padding:0.5rem 0.85rem; border-radius:8px; border:1px solid var(--gray-light); cursor:pointer; font-weight:700; color:var(--gray); transition: var(--transition); }
    .progress-steps .step.active { background:var(--primary); color:white; border-color:transparent; transform:translateY(-3px); box-shadow:var(--shadow-lg); }

    .form-steps { background: white; padding: 1.5rem; border-radius: 16px; box-shadow: var(--shadow); border:1px solid rgba(16,24,40,0.03); }
    .form-step { display:none; }
    .form-step.active { display:block; animation: fadeIn 0.45s ease both; }

    .form-grid { display:grid; grid-template-columns: repeat(2,1fr); gap:1rem; }
    .field { display:flex; flex-direction:column; gap:0.5rem; }
    .field.full { grid-column: 1 / -1; }

    label { font-weight:700; color:var(--dark); font-size:0.95rem; }
    .form-input, .modern-select, .form-textarea { padding:0.8rem 1rem; border-radius:12px; border:1px solid var(--gray-light); background:white; font-size:0.95rem; color:var(--dark); box-shadow:none; transition: var(--transition); }
    .form-input:focus, .modern-select:focus, .form-textarea:focus { outline:none; border-color:var(--primary); box-shadow: 0 6px 24px rgba(225,112,0,0.08); }

    .hint { font-size:0.85rem; color:var(--gray); }

    .step-actions { margin-top:1.25rem; display:flex; justify-content:space-between; align-items:center; gap:1rem; }
    .btn { padding: 0.7rem 1.1rem; border-radius:10px; border: none; cursor:pointer; font-weight:700; transition: var(--transition); display:inline-flex; align-items:center; gap:0.5rem; }
    .btn-primary { background:var(--primary); color:white; }
    .btn:hover { transform: translateY(-3px); box-shadow: var(--shadow-lg); }
    .btn-prev { background:white; color:var(--primary); border:1px solid var(--gray-light); }
    .btn-next { background:var(--primary); color:white; }

    .submit-buttons { display:flex; gap:0.8rem; }
    .btn-draft { background: #f8f9fa; color:var(--dark); border:1px solid var(--gray-light); }
    .btn-submit { background: linear-gradient(90deg,var(--primary),var(--accent)); color:white; }

    /* Upload */
    .upload-zone { background: linear-gradient(180deg,#fff,#f6f8fa); border: 2px dashed var(--gray-light); padding:2rem; border-radius:12px; text-align:center; position:relative; cursor:pointer; transition: var(--transition); }
    .upload-zone.dragover { background: linear-gradient(180deg,#fff,#eef7f3); border-color: var(--primary); box-shadow: 0 10px 30px rgba(12,38,60,0.06); }
    .upload-zone input[type=file] { position:absolute; top:0; left:0; width:100%; height:100%; opacity:0; cursor:pointer; }
    .upload-message strong { display:block; font-weight:800; margin-bottom:0.25rem; color:var(--dark); }

    .media-preview { display:flex; gap:0.75rem; margin-top:1rem; flex-wrap:wrap; }
    .media-item { width:120px; border-radius:10px; overflow:hidden; background:white; border:1px solid var(--gray-light); position:relative; box-shadow:var(--shadow); }
    .media-item img, .media-item video, .media-item audio { width:100%; height:100%; display:block; object-fit:cover; }
    .media-remove { position:absolute; top:6px; right:6px; background:rgba(0,0,0,0.6); color:white; border:none; width:28px; height:28px; border-radius:50%; display:flex; align-items:center; justify-content:center; cursor:pointer; }

    .consent-box { display:flex; gap:0.5rem; align-items:flex-start; }
    .consent-box input { margin-top:4px; }

    /* Guideline cards */
    .guidelines-modern { padding:3rem 0; border-radius:12px; margin-top:1.5rem; }
    .guidelines-grid { display:grid; grid-template-columns: repeat(3,1fr); gap:1rem; }
    .guideline-card { background: linear-gradient(180deg, rgba(255,255,255,0.03), rgba(255,255,255,0.02)); padding:1.5rem; border-radius:12px; text-align:center; color:white; }
    .guideline-icon { width:72px; height:72px; border-radius:12px; display:flex; align-items:center; justify-content:center; margin:0 auto 1rem; font-size:1.6rem; background: linear-gradient(90deg, rgba(255,255,255,0.08), rgba(255,255,255,0.03)); }

    /* Animations & responsive */
    @keyframes fadeIn { from{opacity:0; transform:translateY(12px)} to{opacity:1; transform:none} }
    @media (max-width: 900px) {
        .hero-inner { grid-template-columns: 1fr; text-align:center; }
        .hero-right { order:-1; }
        .form-grid { grid-template-columns: 1fr; }
        .guidelines-grid { grid-template-columns: 1fr; }
    }
    @media (max-width:480px){
        .hero-left h1 { font-size:1.6rem; }
        .stat-number { font-size:1.1rem; }
        .media-item { width:88px; }
    }

    /* Focus visible */
    .form-input:focus-visible, .modern-select:focus-visible, .btn:focus-visible { outline:3px solid rgba(225,112,0,0.18); outline-offset:3px; }

    /* error styling */
    .error { border-color:#e74c3c !important; box-shadow: 0 6px 20px rgba(231,76,60,0.08) !important; }
    .form-message { position: fixed; right: 20px; top: 20px; padding: 0.8rem 1rem; border-radius:8px; display:none; color:white; font-weight:700; z-index:9999; }
    .form-message.show { display:block; }
    .form-message.success { background: #27ae60; }
    .form-message.error { background: #e74c3c; }

</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // ---------- Helpers ----------
    const el = (sel) => document.querySelector(sel);
    const els = (sel) => Array.from(document.querySelectorAll(sel));
    const form = el('#contributionForm');

    // Animate stat numbers
    els('.stat-number').forEach(n => {
        const target = parseInt(n.dataset.target || '0', 10);
        let current = 0;
        const duration = 1200;
        const step = Math.max(1, Math.floor(target / (duration / 16)));
        const run = setInterval(() => {
            current += step;
            if (current >= target) { current = target; clearInterval(run); }
            n.textContent = current.toLocaleString();
        }, 16);
    });

    // ---------- Multi-step logic ----------
    let currentStep = 1;
    const totalSteps = els('.form-step').length;
    const progressFill = el('.progress-fill');

    function showStep(step) {
        if (step < 1 || step > totalSteps) return;
        currentStep = step;
        els('.form-step').forEach(s => s.classList.remove('active'));
        const active = el(`.form-step[data-step="${step}"]`);
        active.classList.add('active');

        els('.progress-steps .step').forEach(b => b.classList.toggle('active', parseInt(b.dataset.step) === step));
        const percent = Math.round(((step - 1) / (totalSteps - 1)) * 100);
        progressFill.style.width = percent + '%';
        // update aria
        el('.progress-bar').setAttribute('aria-valuenow', percent);
    }

    // Prev / Next buttons
    els('.btn-next').forEach(btn => {
        btn.addEventListener('click', () => {
            if (validateStep(currentStep)) {
                showStep(Math.min(totalSteps, currentStep + 1));
                window.scrollTo({ top: el('#formSection').offsetTop - 60, behavior: 'smooth' });
            } else {
                flashMessage('Veuillez remplir les champs requis.', 'error');
            }
        });
    });

    els('.btn-prev').forEach(btn => {
        btn.addEventListener('click', () => {
            showStep(Math.max(1, currentStep - 1));
            window.scrollTo({ top: el('#formSection').offsetTop - 60, behavior: 'smooth' });
        });
    });

    // Direct step click
    els('.progress-steps .step').forEach(s => {
        s.addEventListener('click', () => {
            const step = parseInt(s.dataset.step);
            if (step <= currentStep || validateStep(currentStep)) showStep(step);
            else flashMessage('Remplissez d’abord les étapes précédentes.', 'error');
        });
    });

    // Validate fields of a step
    function validateStep(step) {
        const stepEl = el(`.form-step[data-step="${step}"]`);
        if (!stepEl) return true;
        const required = Array.from(stepEl.querySelectorAll('[required]'));
        let ok = true;
        required.forEach(i => {
            if (!i.value || (i.type === 'checkbox' && !i.checked)) {
                i.classList.add('error');
                ok = false;
            } else {
                i.classList.remove('error');
            }
        });
        return ok;
    }

    // ---------- Upload zone ----------
    const uploadZone = el('#uploadZone');
    const fileInput = uploadZone.querySelector('.file-input');
    const mediaPreview = el('#mediaPreview');

    // drag events
    ['dragenter','dragover'].forEach(ev => uploadZone.addEventListener(ev, (e) => {
        e.preventDefault(); uploadZone.classList.add('dragover');
    }));
    ['dragleave','drop'].forEach(ev => uploadZone.addEventListener(ev, (e) => {
        e.preventDefault(); uploadZone.classList.remove('dragover');
    }));

    uploadZone.addEventListener('drop', (e) => {
        handleFiles(e.dataTransfer.files);
    });

    fileInput.addEventListener('change', (e) => {
        handleFiles(e.target.files);
    });

    function handleFiles(files) {
        Array.from(files).forEach(file => {
            if (!file) return;
            if (file.size > 10 * 1024 * 1024) { flashMessage('Fichier trop volumineux (max 10MB).', 'error'); return; }
            const reader = new FileReader();
            reader.onload = (ev) => {
                const url = ev.target.result;
                const item = document.createElement('div');
                item.className = 'media-item';
                let inner = '';
                if (file.type.startsWith('image/')) {
                    inner = `<img src="${url}" alt="${escapeHtml(file.name)}">`;
                } else if (file.type.startsWith('video/')) {
                    inner = `<video controls muted src="${url}"></video>`;
                } else if (file.type.startsWith('audio/')) {
                    inner = `<audio controls src="${url}"></audio>`;
                } else {
                    inner = `<div style="padding:0.75rem;">Fichier: ${escapeHtml(file.name)}</div>`;
                }
                inner += `<button type="button" class="media-remove" title="Supprimer">&#10005;</button>`;
                item.innerHTML = inner;
                mediaPreview.appendChild(item);

                // remove button
                item.querySelector('.media-remove').addEventListener('click', () => item.remove());
            };
            // read as data url
            reader.readAsDataURL(file);
        });
    }

    // Escape HTML for safety in preview labels
    function escapeHtml(text) {
        return text.replace(/[&<>"'`=\/]/g, function(s){ return ({ '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;','/':'&#x2F;','`':'&#x60;','=':'&#x3D;' })[s]; });
    }

    // ---------- Draft save (front demo) ----------
    el('#saveDraft').addEventListener('click', function() {
        // basic demo: show message
        flashMessage('Brouillon enregistré localement (fonctionnalité demo).', 'success');
        // you can add localStorage save here if desired
    });

    // ---------- Form submission ----------
    form.addEventListener('submit', function(e) {
        // client validation
        if (!validateStep(currentStep)) {
            e.preventDefault();
            flashMessage('Veuillez corriger les erreurs avant de soumettre.', 'error');
            return false;
        }
        // simple captcha check (client demo)
        const captcha = el('#captcha').value.trim();
        if (captcha.toUpperCase() !== 'BENIN') {
            e.preventDefault();
            el('#captcha').classList.add('error');
            flashMessage("Tapez 'BENIN' dans le champ de vérification.", 'error');
            showStep(3);
            return false;
        }
        // show loading state on submit
        const submitBtn = form.querySelector('.btn-submit');
        submitBtn.classList.add('loading');
        submitBtn.disabled = true;
        // allow actual form submission to server
    });

    // ---------- Small utilities ----------
    function flashMessage(message, type='success') {
        let box = el('.form-message');
        if (!box) {
            box = document.createElement('div');
            box.className = 'form-message';
            document.body.appendChild(box);
        }
        box.textContent = message;
        box.className = 'form-message show ' + (type === 'error' ? 'error' : 'success');
        setTimeout(()=>{ box.classList.remove('show'); }, 3200);
    }

    // remove error on input
    els('.form-input, .modern-select, .form-textarea').forEach(i => {
        i.addEventListener('input', () => i.classList.remove('error'));
    });

    // A11y: keyboard navigation for step buttons
    els('.progress-steps .step').forEach(btn => {
        btn.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); btn.click(); }
        });
    });

    // initialize
    showStep(1);
});
</script>
@endpush
