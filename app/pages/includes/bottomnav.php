<div class="d-flex justify-content-center bottom-nav">
           <div class="bottom-navigation">
                <ul>
                    <li class="bottom-list active">
                        <a href="<?=ROOT?>/home">
                            <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                            <span class="text">Home</span>
                        </a>
                    </li>
                    <li class="bottom-list">
                        <a href="<?=ROOT?>/browse">
                            <span class="icon"><ion-icon name="planet-outline"></ion-icon></span>
                            <span class="text">Browse</span>
                        </a>
                    </li>
                    <li class="bottom-list">
                        <a href="<?=ROOT?>/blog">
                            <span class="icon"><ion-icon name="book-outline"></ion-icon></span>
                            <span class="text">Blogs</span>
                        </a>
                    </li>
                    <li class="bottom-list">
                        <a href="<?=ROOT?>/about">
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
    const localStorageKey = 'activeLink';

    function setActiveLink() {
        const activeIndex = localStorage.getItem(localStorageKey);
        if (activeIndex !== null) {
            bottom_list.forEach((item, index) => {
                if (index == activeIndex) {
                    item.classList.add('active');
                } else {
                    item.classList.remove('active');
                }
            });
        }
    }

    function activeLink(e) {
        e.preventDefault();
        const currentIndex = Array.from(bottom_list).indexOf(this);
        localStorage.setItem(localStorageKey, currentIndex.toString());

        bottom_list.forEach(item => item.classList.remove('active'));
        this.classList.add('active');
        const href = this.querySelector('a').getAttribute('href');
        setTimeout(() => {
            window.location.href = href;
        }, 500);
    }

    bottom_list.forEach(item => item.addEventListener('click', activeLink));
    window.addEventListener('DOMContentLoaded', setActiveLink);
</script>

