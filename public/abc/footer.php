    <footer class="overflow-hidden">
        <div class="container site__footer shadow bg-white">
            <div class="text-center">
                <div class="site__credit text-center">
                    <p>Copyright Wake Up ICT ©<span id="year"></span>. All rights reserved</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.getElementById("year").innerHTML = new Date().getFullYear();
    </script>

    <script type="text/javascript" src="vue/attandence.js"></script>
    <script src="./bootstrap/js/jquery.slim.js"></script>
    <script src="./bootstrap/js/poper.min.js"></script>
    <script src="./bootstrap/js/bootstrap.min.js"></script>
    <!-- Select2 -->
    <script src="./plugins/select2/js/select2.full.min.js"></script>
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2();

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })
    </script>

    </body>

    </html>