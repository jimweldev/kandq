			</div>
		</main>
	</div>
</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
<script src="<?= $baseUrl; ?>assets/js/app.js"></script>
<script>
	Fancybox.bind('[data-fancybox="gallery"]', {
		Thumbs: {
			autoStart: false,
		},

		Toolbar: {
			display: [
				{ id: "counter", position: "center" },
				{ id: "close", position: "right" },
			],
		},
	});
</script>
<script type="text/javascript">
	$(document).ready( function () {
	    $('#datatables-reponsive').DataTable();
	} );
</script>
</body>
</html>