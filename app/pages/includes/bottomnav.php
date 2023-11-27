         
           <div class="bottom-navigation">
                <ul>
                    <li class="bottom-list active">
                        <a href="#">
                            <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                            <span class="text">Home</span>
                        </a>
                    </li>
                    <li class="bottom-list">
                        <a href="#">
                            <span class="icon"><ion-icon name="planet-outline"></ion-icon></span>
                            <span class="text">Browse</span>
                        </a>
                    </li>
                    <li class="bottom-list">
                        <a href="#">
                            <span class="icon"><ion-icon name="book-outline"></ion-icon></span>
                            <span class="text">Blogs</span>
                        </a>
                    </li>
                    <li class="bottom-list">
                        <a href="#">
                            <span class="icon"><ion-icon name="people-outline"></ion-icon></span>
                            <span class="text">About</span>
                        </a>
                    </li>
                    <div class="indicator"></div>
                </ul>
            </div>

    </div>
    <script>
        const bottom_list = document.querySelectorAll('.bottom-list');
        function activeLink(e){
            e.preventDefault();
            bottom_list.forEach(item =>  item.classList.remove('active'))
            this.classList.add('active');
        }

        bottom_list.forEach((item)=> item.addEventListener('click', activeLink));
    </script>