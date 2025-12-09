document.addEventListener('DOMContentLoaded', () => {
  const starGroups = document.querySelectorAll('.stars');
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

  starGroups.forEach(group => {
  const stars = group.querySelectorAll('.star');

  const input = group.closest('.bg-primary').querySelector('.mark-input');

  stars.forEach((star, index) => {
    star.addEventListener('click', () => {

      stars.forEach((s, i) => {
        if (i <= index) {
          s.classList.remove('fa-regular');
          s.classList.add('fa-solid');
          s.classList.add('text-yellow-400!');
        } else {
          s.classList.remove('fa-solid');
          s.classList.add('text-yellow-400');
          s.classList.add('fa-regular');
        }
      });
      const filledCount = group.querySelectorAll('.fa-solid').length;
      input.value = filledCount;

    });
  });
});
});

