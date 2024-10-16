jQuery(window).load(function($) {
        
    setTimeout(function(){ fixtitleHeight() }, 1000);
});

function fixtitleHeight(){
        var Titlehight = 0;
        var Contentheight = 0;
        var Boxheight = 0;
        var ScrollBoxheight = 0;

        jQuery('.list-right-sidebar .card-block .card-body').height("100%");
        jQuery('#recipeCarousel .card-block .card-body').height("100%");

        if(jQuery(window).width() < 767) return false;
            jQuery('.list-right-sidebar .card-block .card-body').each(function($){
                                 if(jQuery(this).height() > Boxheight){
                                     Boxheight = jQuery(this).height();
                                 }
            });
            jQuery('#recipeCarousel .card-block .card-body').each(function($){
                                 if(jQuery(this).height() > ScrollBoxheight){
                                     ScrollBoxheight = jQuery(this).height();
                                 }
            });
        
            jQuery('.list-right-sidebar .card-block .card-body').height(Boxheight);
            jQuery('#recipeCarousel .card-block .card-body').height(ScrollBoxheight);


}

jQuery(window).on('resize', function(){
    setTimeout(fixtitleHeight(), 1000);
});


$(window).scroll(function(){
   if ($(window).scrollTop() >= 100) {
       $('header').addClass('fixed-header');
   }
   else {
       $('header').removeClass('fixed-header');
   }
});


// Add event listeners to filter buttons
document.querySelectorAll('#myBtnContainer li a').forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        const slug = this.getAttribute('href').substring(1); 
        filterSelectionWithUrl(slug);  
    });
});



//Filter function
function filterSelection(c) {
    const posts = document.querySelectorAll('.card-block');
    const paginationContainer = document.getElementById('pagination');

    // remove active class from all buttons
    const buttons = document.querySelectorAll("#myBtnContainer li a");
    buttons.forEach(button => {
        button.classList.remove("active");
    });

    document.querySelector(`a[href="#${c}"]`).classList.add("active");

   
    let currentPage = 1;

    // show/hide posts based on selected category
    posts.forEach(post => {
        const postCategory = post.getAttribute('data-category');
        if (c === 'all' || postCategory === c) {
            post.style.display = 'block';
        } else {
            post.style.display = 'none';
        }
    });

    updatePagination(currentPage, c);
}


document.addEventListener('DOMContentLoaded', function() {
    const postsPerPage = 3;  // Set how many posts per page
    const posts = document.querySelectorAll('.card-block');
    const paginationContainer = document.getElementById('pagination');

    // Create a span for page count
    const pageCountItem = document.createElement('li');
    pageCountItem.className = 'page-count'; // add class 
    paginationContainer.appendChild(pageCountItem); 

    // function to handle pagination
    function paginatePosts(currentPage = 1, filteredPosts) {
        paginationContainer.innerHTML = '';  
        paginationContainer.appendChild(pageCountItem); 

        // calculate total pages
        const totalPages = Math.ceil(filteredPosts.length / postsPerPage);
        console.log(totalPages);

        // Update page count text
        pageCountItem.textContent = `Page ${currentPage} of ${totalPages}`;

        // pagination links
        for (let i = 1; i <= totalPages; i++) {
            const link = document.createElement('li');
            link.classList.add('page-item');

            const pageLink = document.createElement('a');
            pageLink.classList.add('page-link');
            pageLink.href = '#';  
            pageLink.textContent = i;

            // event listener to handle pagination
            pageLink.addEventListener('click', function(event) {
                event.preventDefault();  
                paginatePosts(i, filteredPosts);  
            });

            link.appendChild(pageLink);
            paginationContainer.appendChild(link);
        }

        // next button works only if there is multiple pages
        if (totalPages > 1) {
            const nextButton = document.createElement('li');
            nextButton.classList.add('page-item');

            const nextLink = document.createElement('a');
            nextLink.classList.add('page-link', 'link-text');  
            nextLink.href = '#';  
            nextLink.textContent = 'Next';

            // event listener for next button
            nextLink.addEventListener('click', function(event) {
                event.preventDefault();  
                if (currentPage < totalPages) {
                    paginatePosts(currentPage + 1, filteredPosts);  
                }
            });

            nextButton.appendChild(nextLink);
            paginationContainer.appendChild(nextButton);
        }


        // Show/hide posts based on current page
        filteredPosts.forEach((post, index) => {
            if (index >= (currentPage - 1) * postsPerPage && index < currentPage * postsPerPage) {
                post.style.display = 'block';  // open
            } else {
                post.style.display = 'none';    //close
            }
        });

        // add class in the pagenation tabs
        const pageItems = document.querySelectorAll('.page-item');
        pageItems.forEach((item, index) => {
            if (index === currentPage - 1) {
                item.classList.add('active');  // add
            } else {
                item.classList.remove('active'); // remove
            }
        });
    }

    // Function to handle filtering
    function filterSelection(slug) {
        const filteredPosts = Array.from(posts).filter(post => {
            const postCategory = post.getAttribute('data-id');
            return slug === 'all' || postCategory.includes(slug);
        });

        paginatePosts(1, filteredPosts);
    }

    // Initial pagination setup to show only the first 3 posts
    paginatePosts(1, posts); 

    // event listeners for filter tabs
    document.querySelectorAll('#myBtnContainer li a').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            const slug = this.getAttribute('href').substring(1); 

            // remove active class
            document.querySelectorAll('#myBtnContainer li a').forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            
            filterSelection(slug);
        });
    });
});




// add active class to the banner slider
document.addEventListener('DOMContentLoaded', function() {
    const carouselItems = document.querySelectorAll('.carousel-item');
    if (carouselItems.length > 0) {
        carouselItems.forEach(item => item.classList.remove('active'));
        carouselItems[0].classList.add('active');
    }
});

