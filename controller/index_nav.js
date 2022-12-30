// JavaScript Document
        $("#getLINEQR").click(function () {
            let title = "【LINE@KEYs QR Code】掃瞄加入KEYs行銷利器LINE討論群";
            let content = `
				<div>
					<img src='https://www.wmpcca.com/bswmp/form/img/KEYsLINEqrcode.png' alt='' width='50%' height='50%' style='display:block;margin:auto;'>
				</div>
					`
            setInModal(title, content);
		})


        $("#navplanner").click(function () {
            let title = "";
            let content = `
				<div>
					<p>此功能尚未開放！</p>
				</div>
					`
            setInModal(title, content);
		})




        function setInModal(title,content) {
            $("#exampleModal .modal-title").html(title);
            $("#exampleModal .modal-body").html(content);
            $("#exampleModal").modal("show");
        }