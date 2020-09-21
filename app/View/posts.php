<?php foreach ($listPost as $post): ?>
<p><?= htmlspecialchars($post['title']) ?></p>
<p><?=  nl2br(htmlspecialchars($post['contenu']))  ?></p>
<p><?= $post['create_at'] ?></p>

<?php
endforeach;