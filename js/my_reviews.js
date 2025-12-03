document.addEventListener('DOMContentLoaded', () => {
  const stars = document.querySelectorAll('.star');
  const inputMark = document.getElementById('mark');
  const checksReview = document.querySelectorAll('#check-review');

  checksReview.forEach((cr) => {
    cr.addEventListener('mouseover', (e) => {
      e.target.firstElementChild.classList.remove('hidden')
      e.target.firstElementChild.classList.add('block')
    })
    cr.addEventListener('mouseleave', (e) => {
      e.target.firstElementChild.classList.remove('block')
      e.target.firstElementChild.classList.add('hidden')
    })
  })

  stars.forEach((star, index) => {
    star.addEventListener('click', () => {

      stars.forEach((s, i) => {
        if (i <= index) {
          s.classList.remove('fa-regular');
          s.classList.add('fa-solid');
        } else {
          s.classList.remove('fa-solid');
          s.classList.add('fa-regular');
        }
      });
      
      inputMark.value = document.querySelectorAll('.fa-solid.star').length;
      console.log(inputMark.value)

    });
  });
});