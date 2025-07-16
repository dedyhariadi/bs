 const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'], // Labels bulanan
                datasets: [{
                        label: 'SOC Baterai', // Label untuk garis pertama
                        data: [12, 19, 3, 5, 2, 3, 8, 11, 15, 10, 6, 4], // Data untuk garis pertama
                        borderColor: 'rgb(75, 192, 192)', // Warna garis untuk garis pertama
                        backgroundColor: 'rgba(75, 192, 192, 0.2)', // Warna latar belakang untuk area di bawah garis pertama
                        borderWidth: 2, // Ketebalan garis
                        tension: 0.4 // Membuat garis mulus
                    },
                    {
                        label: 'KWH Baterai', // Label untuk garis kedua
                        data: [20, 22, 18, 25, 23, 20, 28, 26, 24, 21, 19, 17], // Data contoh untuk garis kedua
                        borderColor: 'rgb(255, 99, 132)', // Warna garis untuk garis kedua
                        backgroundColor: 'rgba(255, 99, 132, 0.2)', // Warna latar belakang untuk area di bawah garis kedua
                        borderWidth: 2,
                        tension: 0.4 // Membuat garis mulus
                    }
                ]
            },
            options: {

                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                tension: 0.4,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            color: '#333',
                            font: {
                                size: 14
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Grafik SOC Battery Bulanan',
                        color: '#333',
                        font: {
                            size: 18
                        }
                    }
                }

            }
        });