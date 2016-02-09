<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="/assets/styles.css">
	<meta charset="utf-8">
	<title>My Wishlist</title>
</head>
<body>
	<a href="/logins/logout_user"><p>Logout</p></a>
	<h1>Hello, <?= $user['name'] ?>!</h1>
	<div id="your_wishlist">
		<h3>Your Wishlist:</h3>
		<div>
			<table>
				<tr>
					<th>Item</th>
					<th>Added by</th>
					<th>Date Added</th>
					<th>Action</th>
				</tr>
			<? foreach($your_items as $your_item) { ?>
				<tr>
					<td>
						<a href="/item_view/<?= $your_item['id'] ?>"><p><?= $your_item['item'] ?></p></a>
					</td>
					<td><?= $your_item['added_by'] ?></td>
					<?php $date = strtotime($your_item["created_at"]); ?>
					<td><?= date('M d Y', $date) ?></td>
					<td>
						<form action="/logins/remove_from_wishlist" method="post">
			        		<input type="hidden" value="<?= $your_item['wish_id'] ?>" name="wish_id">
			        		<input type="submit" value="Remove from my Wishlist">
			        	</form>
					</td>
    			</tr>
        	<?php } ?>
        	<? foreach($created_items as $created_item) { ?>
				<tr>
					<td>
						<a href="/item_view/<?= $created_item['item_id'] ?>"><p><?= $created_item['item'] ?></p></a>
					</td>
					<td><?= $created_item['added_by'] ?></td>
					<?php $date = strtotime($created_item['created_at']); ?>
					<td><?= date('M d Y', $date) ?></td>
					<td>
						<form action="/logins/delete_item" method="post">
			        		<input type="hidden" value="<?= $created_item['wish_id'] ?>" name="wish_id">
			        		<input type="hidden" value="<?= $created_item['item_id'] ?>" name="item_id">
			        		<input type="submit" value="Delete">
			        	</form>
					</td>
    			</tr>
        	<?php } ?>
        	</table>
        </div>
	</div>
	<div id="others_wishlist">
		<h3>Other Users' Wishlists</h3>
		<div>
			<table>
				<tr>
					<th>Item</th>
					<th>Added by</th>
					<th>Date Added</th>
					<th>Action</th>
				</tr>
			<? foreach($others_items as $others_item) { ?>
				<tr>
					<td>
						<a href="/item_view/<?= $others_item['id'] ?>"><p><?= $others_item['item'] ?></p></a>
					</td>
					<td><?= $others_item['added_by'] ?></td>
					<?php $date = strtotime($others_item['created_at']); ?>
					<td><?= date('M d Y', $date) ?></td>
					<td>
						<form action="/logins/add_to_wishlist" method="post">
			        		<input type="hidden" value="<?= $others_item['id'] ?>" name="item_id">
			        		<input type="submit" value="Add to my Wishlist">
			        	</form>
					</td>
        		</tr>
        	<?php } ?>
        	</table>
        </div>
	</div>
	<a href="/add_item_view"><button>Add Item</button></a>
</body>
</html>