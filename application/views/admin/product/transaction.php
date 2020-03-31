<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("admin/_partials/head.php") ?>
</head>

<body id="page-top">

	<?php $this->load->view("admin/_partials/navbar.php") ?>
	<div id="wrapper">

		<?php $this->load->view("admin/_partials/sidebar.php") ?>

		<div id="content-wrapper">

			<div class="container-fluid">

				<!-- DataTables -->
				<div class="card mb-3">
					<div class="card-header">
						Daftar Transaksi
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>Product</th>
										<th>User ID</th>
										<th>Address</th>
										<th>Postal Code</th>
										<th>Amount</th>
										<th>Total Price</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($transactions as $transaction): ?>
									<tr>
										<td width="150">
											<?php	
												$product = $this->product_model; 
												$data = $product->getById($transaction->product_id);
												echo $data->name
											?>
										</td>
										<td>
											<?php echo $transaction->user_id ?>
										</td>
										<td>
											<?php echo $transaction->alamat ?>
										</td>
										<td>
											<?php echo $transaction->kodepos ?>
										</td>
										<td>
											<?php echo $transaction->jumlah ?>
										</td>
										<td>
											<?php echo $transaction->total_harga ?>
										</td>
										<td>
											<?php echo $transaction->transaction_made ?>
										</td>
									</tr>
									<?php endforeach; ?>

								</tbody>
							</table>
						</div>
						
					</div>
				</div>

			</div>
			<!-- /.container-fluid -->

			<!-- Sticky Footer -->
			<?php $this->load->view("admin/_partials/footer.php") ?>

		</div>
		<!-- /.content-wrapper -->

	</div>
	<!-- /#wrapper -->


	<?php $this->load->view("admin/_partials/scrolltop.php") ?>
	<?php $this->load->view("admin/_partials/modal.php") ?>

	<?php $this->load->view("admin/_partials/js.php") ?>

    <script>
    function deleteConfirm(url){
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }
    </script>

</body>

</html>