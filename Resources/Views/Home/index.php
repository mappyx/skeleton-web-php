<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <div class="hero-text">
            <h1>Yogurt Artesanal Hecho con Amor</h1>
            <p>Descubre el sabor auténtico de nuestros yogurts caseros, elaborados con ingredientes naturales y mucho cariño.</p>
            <div class="hero-buttons">
                <a href="#productos" class="btn btn-primary">Ver Productos</a>
                <a href="#contacto" class="btn btn-secondary">Contáctanos</a>
            </div>
        </div>
        <div class="hero-image">
            <img src="/public/images/hero.png" alt="Yogurt Artesanal">
        </div>
    </div>
</section>

<!-- Products Section -->
<section id="productos" class="section">
    <div class="section-header">
        <h2 class="section-title">Nuestros Productos</h2>
        <p class="section-subtitle">Cada variedad está cuidadosamente elaborada con ingredientes frescos y naturales</p>
    </div>
    
    <div class="products-grid">
        <?php foreach ($dataController['products'] as $index => $product): ?>
        <div class="product-card">
            <img src="/public/images/products.png" alt="<?= htmlspecialchars($product['name']) ?>" class="product-image">
            <div class="product-content">
                <h3 class="product-title"><?= htmlspecialchars($product['name']) ?></h3>
                <p class="product-description"><?= htmlspecialchars($product['description']) ?></p>
                <div class="product-price"><?= htmlspecialchars($product['price']) ?></div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Features Section -->
<section class="features">
    <div class="section-header">
        <h2 class="section-title">¿Por Qué Elegirnos?</h2>
        <p class="section-subtitle">Calidad y dedicación en cada envase</p>
    </div>
    
    <div class="features-grid">
        <?php foreach ($dataController['features'] as $feature): ?>
        <div class="feature-card">
            <div class="feature-icon"><?= $feature['icon'] ?></div>
            <h3 class="feature-title"><?= htmlspecialchars($feature['title']) ?></h3>
            <p><?= htmlspecialchars($feature['description']) ?></p>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Process Section -->
<section id="proceso" class="section process">
    <div class="section-header">
        <h2 class="section-title">Nuestro Proceso Artesanal</h2>
        <p class="section-subtitle">De la granja a tu mesa, con amor y dedicación</p>
    </div>
    
    <div class="process-steps">
        <?php foreach ($dataController['process'] as $step): ?>
        <div class="process-step">
            <div class="step-number"><?= $step['number'] ?></div>
            <h3 class="step-title"><?= htmlspecialchars($step['title']) ?></h3>
            <p><?= htmlspecialchars($step['description']) ?></p>
        </div>
        <?php endforeach; ?>
    </div>
    
    <div style="text-align: center; margin-top: 3rem;">
        <img src="/public/images/ingredients.png" alt="Ingredientes Frescos" style="max-width: 100%; height: auto; border-radius: 24px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.16);">
    </div>
</section>

<!-- Contact Section -->
<section id="contacto" class="section contact">
    <div class="section-header">
        <h2 class="section-title">¡Contáctanos!</h2>
        <p class="section-subtitle">Estamos aquí para servirte</p>
    </div>
    
    <div class="contact-info">
        <div class="contact-item">
            <div class="contact-icon">📞</div>
            <div class="contact-text">+1 (555) 123-4567</div>
        </div>
        <div class="contact-item">
            <div class="contact-icon">📧</div>
            <div class="contact-text">hola@dulcecremoso.com</div>
        </div>
        <div class="contact-item">
            <div class="contact-icon">📍</div>
            <div class="contact-text">Calle Principal 123, Ciudad</div>
        </div>
    </div>
</section>