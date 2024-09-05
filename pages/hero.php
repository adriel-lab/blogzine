<?php
include 'C:/xampp/htdocs/Lucas/bd/conexao.php';
// Consulta para obter as 2 postagens mais recentes aleatórias
$query = "SELECT p.id, p.name, p.post_body, p.created_at, c.icon AS category_icon, c.name AS category_name, i.image_path
          FROM posts p
          LEFT JOIN categories c ON p.category_id = c.id
          LEFT JOIN images i ON p.id = i.post_id AND i.image_type = 'cover_image'
          WHERE p.featured = 1
          ORDER BY RAND()
          LIMIT 2";

$result = $conn->query($query);

$posts = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $posts[] = $row;
    }
}
?>

<section class="pt-3 pb-3 mb-2 card-grid">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="tiny-slider arrow-hover arrow-blur arrow-white arrow-round rounded-3 overflow-hidden">
                    <div class="tiny-slider-inner"
                        data-autoplay="true"
                        data-hoverpause="true"
                        data-gutter="1"
                        data-arrow="true"
                        data-dots="false"
                        data-items="1">

                        <?php foreach ($posts as $post): ?>
                            <!-- Slide -->
                            <div class="card bg-dark-overlay-3 h-400 h-sm-500 h-md-600 rounded-0" style="background-image:url('<?php echo !empty($post['image_path']) ? 'http://localhost/Lucas/painel/add-postage/uploads/' . htmlspecialchars($post['image_path']) : 'http://localhost/Lucas/assets/images/blog/4by3/07.jpg'; ?>'); background-position: center left; background-size: cover;">

                                <!-- Card Image overlay -->
                                <div class="card-img-overlay d-flex align-items-center p-3 p-sm-5">
                                    <div class="w-100 my-auto">
                                        <div class="col-md-10 col-lg-7 mx-auto text-center">
                                            <!-- Card category -->
                                            <a href="#" class="badge bg-primary mb-2">
                                                <i class="icon-class"><?php echo !empty($post['category_icon']) ? htmlspecialchars($post['category_icon']) : 'N/A'; ?></i>
                                                <?php echo htmlspecialchars($post['category_name'] ?? 'N/A'); ?>
                                            </a>
                                            <!-- Card title -->
                                            <h2 class="text-white display-5"><a href="post-single-2.php?id=<?php echo $post['id'] ?>" class="btn-link text-reset fw-normal"><?php echo htmlspecialchars($post['name']); ?></a></h2>
                                            <p class="text-white"><?php echo htmlspecialchars(substr($post['post_body'], 0, 100)); ?>...</p>
                                            <!-- Card info -->
                                            <ul class="nav nav-divider text-white-force align-items-center d-none d-sm-inline-block">
                                                <li class="nav-item">
                                                    <div class="nav-link">
                                                        <div class="d-flex align-items-center text-white position-relative">
                                                            <div class="avatar avatar-sm">
                                                                <img class="avatar-img rounded-circle" src="assets/images/avatar/14.jpg" alt="avatar">
                                                            </div>
                                                            <span class="ms-3">by <a href="#" class="stretched-link text-reset btn-link">NEWS</a></span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="nav-item"><?php echo date('M d, Y', strtotime($post['created_at'])); ?></li>
                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
