<?php
// Consulta para obter 12 postagens
$query = "SELECT p.id AS post_id, p.name AS post_title, p.category_id, i.image_path, p.created_at AS date
          FROM posts p
          LEFT JOIN images i ON p.id = i.post_id AND i.image_type = 'cover_image'
          ORDER BY RAND()
          LIMIT 12";

$result = $conn->query($query);

$posts = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $posts[] = $row;
    }
}
?>
<section class="p-0">
    <div class="container">
        <div class="row g-4">
            <?php foreach ($posts as $post): ?>
                <!-- Card item START -->
                <div class="col-sm-6 col-lg-4">
                    <div class="card card-overlay-bottom card-img-scale overflow-hidden">
                        <!-- Card featured -->
                        <?php if (!empty($post['featured']) && $post['featured'] == 1): ?>
                            <span class="card-featured" title="Featured post"><i class="fas fa-star"></i></span>
                        <?php endif; ?>
                        <!-- Card Image -->
                        <img style="width: 500px; height: 400px;"   src="<?php echo !empty($post['image_path']) ? 'http://localhost/Lucas/painel/add-postage/uploads/' . htmlspecialchars($post['image_path']) : 'http://localhost/Lucas/assets/images/default.jpg'; ?>" alt="">
                        <!-- Card Image overlay -->
                        <div class="card-img-overlay d-flex flex-column p-3 p-md-4">
                            <div>
                                <!-- Card category -->
                                <?php
                                // Consulta para obter a categoria do post
                                $category_id = !empty($post['category_id']) ? intval($post['category_id']) : 0;
                                $category_query = "SELECT icon, name FROM categories WHERE id = ?";
                                $stmt = $conn->prepare($category_query);
                                $stmt->bind_param("i", $category_id);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $category = $result->fetch_assoc();

                                $category_icon = !empty($category['icon']) ? htmlspecialchars($category['icon']) : '';
                                $category_name = !empty($category['name']) ? htmlspecialchars($category['name']) : 'N/A';
                                ?>
                                <a href="#" class="badge text-bg-<?php echo $category_name == 'Business' ? 'primary' : ($category_name == 'Covid-19' ? 'info' : ($category_name == 'Travel' ? 'dark' : 'warning')); ?> mb-2">
                                    <i class="fas fa-circle me-2 small fw-bold"><?php echo $category_icon; ?></i>
                                    <?php echo $category_name; ?>
                                </a>
                            </div>
                            <div class="w-100 mt-auto">
                                <!-- Card title -->
                                <h4 class="text-white"><a href="post-single-2.php?id=<?php echo htmlspecialchars($post['post_id']); ?>" class="btn-link text-reset stretched-link">
                                    <?php echo htmlspecialchars($post['post_title']); ?>
                                </a></h4>
                                <!-- Card info -->
                                <ul class="nav nav-divider text-white-force align-items-center small">
                                    <li class="nav-item position-relative">
                                        
                                    </li>
                                    <li class="nav-item"><?php echo date('M d, Y', strtotime($post['date'])); ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card item END -->
            <?php endforeach; ?>
        </div> <!-- Row END -->
    </div>
</section>
