			</div>
		</main>
	</div>
</div>

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
</body>
</html>