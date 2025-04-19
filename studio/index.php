<?php
	define('WAY', '../accounts/');

	$name = $_COOKIE['name'];

	$usr = json_decode(file_get_contents(WAY . $name . ".conf"));

?>

<!DOCTYPE html>
<html>
<head>
	<title><?=$usr->name?>'s studio</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../style/styleStudio.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Golos+Text:wght@400..900&display=swap" rel="stylesheet">
	<link rel="icon" href="/favicon.ico" type="image/x-icon">
</head>
<body>
	<div class="container">
		<div class="header" id="header">
			<a href="/" class="headerBubble">
                <span class="bubbleText">FreeTube</span>
                <span class="bubbleTextsh">FreeTube</span>
			</a>
			
			<div class="headerBubble2" id="headerBubble">
				<div class="slider" id="themeSelecter">
					<div class="bubble" style="background-color:rgb(255, 255, 255);"></div>
					<div class="bubble" style="background-color:rgb(31, 31, 31);"></div>
					<div class="bubble" style="background-color:rgb(81, 107, 225);"></div>
					<div class="bubble" style="background-color:rgb(87, 195, 137);"></div>
					<div class="bubble" style="background-color: #FF33A8;"></div>
					<div class="bubble" style="background-color: #FFBD33;"></div>
					<div class="bubble" style="background-color: #33FFF0;"></div>
					<div class="bubble" style="background-color: #A833FF;"></div>
				</div>
			</div>

			<a href="/profile.php" class="headerBubble3">
				<img class="profileIcon" width="25" height="25" src="../ico/profileicon.png"/>
			</a>

			<script>
				const slider = document.getElementById("themeSelecter");
				let index = 0;
				const totalBubbles = document.querySelectorAll(".bubble").length;
				const bubbleWidth = 26;

				slider.addEventListener("wheel", (event) => {
					event.preventDefault(); // Prevent default page scrolling
					index += event.deltaY > 0 ? 1 : -1;
					index = Math.max(0, Math.min(index, totalBubbles - 3));
					slider.style.transform = `translateX(${-index * bubbleWidth}px)`;
				});
			</script>

		</div>
		
		<form action="./studio.php" method="POST" enctype="multipart/form-data" id="uploadForm">
			<div class="form">
				<div class="stepUpload active" id="step1">
					<div class="bg">
						<div class="bgText">Upload</div>
						<label class="uploadbutton" for="fileInput">Choose File</label>
						<input type="file" id="fileInput" name="file" accept="video/*" required>
						<span id="fileName" class="file-name">No file selected</span>
						<button class="nextButton" type="button" id="nextBtn1">Next</button>
					</div>
				</div>

				<div class="stepName inactive" id="step2">
					<div class="bg">
						<div class="bgText">Name</div>
						<input type="text" name="title" placeholder="Video Title" title="Title text" required>
						<button class="nextButton" type="button" id="nextBtn2">Next</button>
						<button class="backButton" type="button" id="backBtn1">Back</button>
					</div>
				</div>

				<div class="stepBanner inactive" id="step3">
					<div class="bg">
						<div class="bgText">Banner</div>
						<label class="uploadbutton" for="previewInput">Choose Preview</label>
						<input type="file" id="previewInput" name="preview" accept="image/png" required>
						<button class="nextButton" type="button" id="nextBtn3">Next</button>
						<button class="backButton" type="button" id="backBtn2">Back</button>
					</div>
				</div>

				<div class="stepDescription inactive" id="step4">
					<div class="bg">
						<div class="bgText">Description</div>
						<textarea name="description" placeholder="Description" title="Describe your video"></textarea>
						<button class="submitButton" type="submit">Submit</button>
						<button class="backButton" type="button" id="backBtn3">Back</button>
					</div>
				</div>
			</div>
		</form>
		<script>
			const steps = [
				document.getElementById('step1'),
				document.getElementById('step2'),
				document.getElementById('step3'),
				document.getElementById('step4')
			];

			let currentStep = 0;

			const nextButtons = [
				document.getElementById('nextBtn1'),
				document.getElementById('nextBtn2'),
				document.getElementById('nextBtn3')
			];

			const backButtons = [
				document.getElementById('backBtn1'),
				document.getElementById('backBtn2'),
				document.getElementById('backBtn3')
			];

			
			nextButtons.forEach((btn, index) => {
				btn.addEventListener('click', () => {
					if (index === 0) {
						const videoInput = document.querySelector('input[name="file"]');
						if (!videoInput.files.length) {
							alert("Please select a video file first.");
							return;
						}
					} else if (index === 1) {
						const titleInput = document.querySelector('input[name="title"]');
						if (!titleInput.value.trim()) {
							alert("Please enter a title for the video.");
							return;
						}
					} else if (index === 2) {
						const previewInput = document.querySelector('input[name="preview"]');
						if (!previewInput.files.length) {
							alert("Please select a preview image.");
							return;
						}
					}

					
					steps[currentStep].classList.remove('active');
					steps[currentStep].classList.add('inactive');

				
					currentStep++;

					
					steps[currentStep].classList.remove('inactive');
					steps[currentStep].classList.add('next');

					
					setTimeout(() => {
						steps[currentStep].classList.remove('next');
						steps[currentStep].classList.add('active');
					}, 50); 
				});
			});

			
			backButtons.forEach((btn, index) => {
				btn.addEventListener('click', () => {
					
					steps[currentStep].classList.remove('active');
					steps[currentStep].classList.add('next'); 

					
					currentStep--;

					
					steps[currentStep].classList.remove('inactive');
					steps[currentStep].classList.add('active');
				});
			});

			const fileInput = document.getElementById('fileInput');
			const fileNameSpan = document.getElementById('fileName');

			fileInput.addEventListener('change', () => {
				if (fileInput.files.length > 0) {
					fileNameSpan.textContent = fileInput.files[0].name; // Display the selected file name
				} else {
					fileNameSpan.textContent = 'No file selected'; // Reset if no file is selected
				}
			});
		</script>
	</div>
</body>
</html>
