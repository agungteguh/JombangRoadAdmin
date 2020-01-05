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

				<?php $this->load->view("admin/_partials/breadcrumb.php") ?>

				<!-- DataTables -->
				<div class="card mb-3">
					<div class="card-header">
						<a href=""><i class="fas fa-plus"></i> Add New</a>
					</div>
					<div class="card-body">

						<div class="table-responsive">
							<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>Name</th>
										<th>Reporterid</th>
										<th>Photo</th>
										<th>Status</th>
										<th>Staffid</th>
										<th>Fixphoto</th>
										<th>Longlocation</th>
										<th>Latlocation</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($reports as $report): ?>
									<tr>
										<td width="150">
											<?php echo $report->Name ?>
										</td>
										<td>
											<?php echo $report->reporterid ?>
										</td>
										<td>
											<img src="<?php echo base_url('upload/product/'.$report->Photo) ?>" width="64" />
										</td>
										<td>
											<?php echo $report->Status ?>
										</td>
										<td width>
											<?php echo $report->staffid ?>
										</td>
										<td>
											<img src="<?php echo base_url('upload/product/'.$report->fixPhoto) ?>" width="64" />
										</td>
										<td>
											<?php echo $report->longlocation ?>
										</td>
										<td>
											<?php echo $report->latlocation ?>
										</td>
										<td width="250">
											<a href="<?php echo site_url('admin/ReportControl/edit/'.$report->No) ?>"
											 class="btn btn-small"><i class="fas fa-edit"></i> Edit</a>
											<a onclick="deleteConfirm('<?php echo site_url('admin/ReportControl/delete/'.$report->No) ?>')"
											 href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i> Hapus</a>
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