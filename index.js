



const ctx = document.querySelector('#blood_chart').getContext('2d');
const cha = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: [  "A","B","O","AB"],
        datasets: [{
            label: '# of Votes',
            data: [3,0,4,1],
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)'
            ],
            hoverOffset: 4
        }]
    },
});
