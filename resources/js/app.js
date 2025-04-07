import './bootstrap';
import 'flowbite';
import ApexCharts from 'apexcharts';


        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        // Change the icons inside the button based on previous settings
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

        var themeToggleBtn = document.getElementById('theme-toggle');

        themeToggleBtn.addEventListener('click', function() {

            // toggle icons inside button
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            // if set via local storage previously
            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                }

                // if NOT set via local storage previously
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
            }

        });

        if (document.getElementById('visitors-chart')) {
            let visitorsChart = document.getElementById('visitors-chart');
            let chart;
        
            const renderChart = (series) => {
                // Destrói o gráfico existente, se houver
                if (chart) {
                    chart.destroy();
                }
        
                // Opções do gráfico
                const options = {
                    series: series,
                    colors: ["#1C64F2", "#16BDCA", "#FDBA8C", "#E74694"],
                    chart: {
                        height: 320,
                        width: "100%",
                        type: "donut",
                    },
                    stroke: {
                        colors: ["transparent"],
                        lineCap: "",
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                labels: {
                                    show: true,
                                    name: {
                                        show: true,
                                        fontFamily: "Inter, sans-serif",
                                        offsetY: 20,
                                    },
                                    total: {
                                        showAlways: true,
                                        show: true,
                                        label: "Total de visitantes",
                                        fontFamily: "Inter, sans-serif",
                                        formatter: function (w) {
                                            const sum = w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                            return sum;
                                        },
                                    },
                                    value: {
                                        show: true,
                                        fontFamily: "Inter, sans-serif",
                                        offsetY: -20,
                                        formatter: function (value) {
                                            return value;
                                        },
                                    },
                                },
                                size: "80%",
                            },
                        },
                    },
                    grid: {
                        padding: {
                            top: -2,
                        },
                    },
                    labels: ["Anônimo", "Cliente", "Profissional", "Colaborador"],
                    dataLabels: {
                        enabled: false,
                    },
                    legend: {
                        position: "bottom",
                        fontFamily: "Inter, sans-serif",
                    },
                    yaxis: {
                        labels: {
                            formatter: function (value) {
                                return value;
                            },
                        },
                    },
                    xaxis: {
                        labels: {
                            formatter: function (value) {
                                return value;
                            },
                        },
                        axisTicks: {
                            show: false,
                        },
                        axisBorder: {
                            show: false,
                        },
                    },
                };
        
                // Cria o gráfico
                chart = new ApexCharts(visitorsChart, options);
                chart.render();
            };
        
            // Renderiza o gráfico inicial com os dados de visitantes
            const initialData = JSON.parse(visitorsChart.dataset.info);
            renderChart([
                initialData["anonymous"],
                initialData["clients"],
                initialData["professionals"],
                initialData["collaborators"],
            ]);
        
            // Observador para mudanças nos atributos
            const observer = new MutationObserver(() => {
                const updatedData = JSON.parse(visitorsChart.dataset.info);
                renderChart([
                    updatedData["anonymous"],
                    updatedData["clients"],
                    updatedData["professionals"],
                    updatedData["collaborators"],
                ]);
            });
        
            observer.observe(visitorsChart, { attributes: true, attributeFilter: ['data-info'] });
        
            // Manipula mudanças nos checkboxes
            const checkboxes = document.querySelectorAll('#devices input[type="checkbox"]');
        
            function handleCheckboxChange(event) {
                const checkbox = event.target;
                let series;
        
                if (checkbox.checked) {
                    const devicesData = JSON.parse(visitorsChart.dataset.devices);
                    switch (checkbox.value) {
                        case "desktop":
                            series = [
                                devicesData["desktop"]["users"]["anonymous"],
                                devicesData["desktop"]["users"]["clients"],
                                devicesData["desktop"]["users"]["professionals"],
                                devicesData["desktop"]["users"]["collaborators"],
                            ];
                            break;
                        case "tablet":
                            series = [
                                devicesData["tablet"]["users"]["anonymous"],
                                devicesData["tablet"]["users"]["clients"],
                                devicesData["tablet"]["users"]["professionals"],
                                devicesData["tablet"]["users"]["collaborators"],
                            ];
                            break;
                        case "mobile":
                            series = [
                                devicesData["mobile"]["users"]["anonymous"],
                                devicesData["mobile"]["users"]["clients"],
                                devicesData["mobile"]["users"]["professionals"],
                                devicesData["mobile"]["users"]["collaborators"],
                            ];
                            break;
                        default:
                            series = [
                                initialData["anonymous"],
                                initialData["clients"],
                                initialData["professionals"],
                                initialData["collaborators"],
                            ];
                    }
                } else {
                    series = [
                        initialData["anonymous"],
                        initialData["clients"],
                        initialData["professionals"],
                        initialData["collaborators"],
                    ];
                }
        
                renderChart(series);
            }
        
            // Adiciona eventos aos checkboxes
            checkboxes.forEach((checkbox) => {
                checkbox.addEventListener("change", handleCheckboxChange);
            });
        
            // Desconecta o observador ao descarregar a página
            window.addEventListener('beforeunload', () => observer.disconnect());
        }
        
                    
            // PRO USERS CHART    
            if (document.getElementById('pro-users-chart')) {
                let proUsersChart = document.getElementById('pro-users-chart');
            
                // Recupera os dados iniciais do gráfico
                let proUsersSeries = JSON.parse(proUsersChart.dataset.series);
                let proUsersCategories = JSON.parse(proUsersChart.dataset.categories);
            
                let chart;
            
                const renderChart = (series, categories) => {
                    if (chart) {
                        chart.destroy(); // Remove o gráfico existente
                    }
            
                    const options = {
                        series: series,
                        chart: {
                            height: 322,
                            maxWidth: "100%",
                            type: "area",
                            fontFamily: "Inter, sans-serif",
                            toolbar: {
                                show: false,
                            },
                        },
                        tooltip: {
                            enabled: true,
                            x: {
                                show: false,
                            },
                        },
                        legend: {
                            show: false,
                        },
                        fill: {
                            type: "gradient",
                            gradient: {
                                opacityFrom: 0.55,
                                opacityTo: 0,
                                shade: "#1C64F2",
                                gradientToColors: ["#1C64F2"],
                            },
                        },
                        dataLabels: {
                            enabled: false,
                        },
                        stroke: {
                            width: 6,
                        },
                        grid: {
                            show: false,
                            strokeDashArray: 4,
                            padding: {
                                left: 2,
                                right: 2,
                                top: 0,
                            },
                        },
                        xaxis: {
                            categories: categories,
                            labels: {
                                show: false,
                            },
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                            },
                        },
                        yaxis: {
                            show: false,
                            labels: {
                                formatter: function (value) {
                                    return value + 'k';
                                },
                            },
                        },
                    };
            
                    chart = new ApexCharts(proUsersChart, options);
                    chart.render();
                };
            
                // Renderiza o gráfico inicial
                renderChart(
                    [
                        {
                            name: "Edição Basic",
                            data: proUsersSeries[0].data,
                            color: "#1A56DB",
                        },
                        {
                            name: "Edição Standard",
                            data: proUsersSeries[1].data,
                            color: "#7E3BF2",
                        },
                        {
                            name: "Edição PRO",
                            data: proUsersSeries[2].data,
                            color: "#e74694",
                        },
                    ],
                    proUsersCategories
                );
            
                // Observador para mudanças no DOM
                const observer = new MutationObserver(() => {
                    const updatedSeries = JSON.parse(proUsersChart.dataset.series);
                    const updatedCategories = JSON.parse(proUsersChart.dataset.categories);
                    renderChart(updatedSeries, updatedCategories);
                });
            
                observer.observe(proUsersChart, { attributes: true, attributeFilter: ['data-series', 'data-categories'] });
            
                // Limpa o observador ao descarregar a página
                window.addEventListener('beforeunload', () => observer.disconnect());
            }


            // SALES CHART
            if (document.getElementById('sales-chart')) {
                const chartElement = document.getElementById('sales-chart');
            
                // Função para renderizar o gráfico
                const renderChart = () => {
                    // Converta o dataset em um array de objetos
                    const data = JSON.parse(chartElement.dataset.info);

                    console.log(data);
            
                    const options = {
                        xaxis: {
                            show: true,
                            categories: data['categories'],
                            labels: {
                                show: true,
                                style: {
                                    fontFamily: "Inter, sans-serif",
                                    cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                                }
                            },
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                            },
                        },
                        yaxis: {
                            show: true,
                            labels: {
                                show: true,
                                style: {
                                    fontFamily: "Inter, sans-serif",
                                    cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                                },
                                formatter: function (value) {
                                    return 'R$' + value;
                                }
                            }
                        },
                        series: [
                            {
                                name: "Transitado",
                                data: data.series[0].data,
                                color: "#1A56DB",
                            },
                            {
                                name: "Lucro",
                                data: data.series[1].data,
                                color: "#7E3BF2",
                            },
                            {
                                name: "Estornado",
                                data: data.series[2].data,
                                color: "#e74694",
                            },
                        ],
                        chart: {
                            sparkline: {
                                enabled: false
                            },
                            height: "100%",
                            width: "100%",
                            type: "area",
                            fontFamily: "Inter, sans-serif",
                            dropShadow: {
                                enabled: false,
                            },
                            toolbar: {
                                show: false,
                            },
                        },
                        tooltip: {
                            enabled: true,
                            x: {
                                show: false,
                            },
                        },
                        fill: {
                            type: "gradient",
                            gradient: {
                                opacityFrom: 0.55,
                                opacityTo: 0,
                                shade: "#1C64F2",
                                gradientToColors: ["#1C64F2"],
                            },
                        },
                        dataLabels: {
                            enabled: false,
                        },
                        stroke: {
                            width: 6,
                        },
                        legend: {
                            show: true
                        },
                        grid: {
                            show: false,
                        },
                    };
            
                    if (typeof ApexCharts !== 'undefined') {
                        const chart = new ApexCharts(chartElement, options);
                        chart.render();
                    }
                };
            
                // Renderizar o gráfico inicialmente
                renderChart();
            
                // Criar um MutationObserver para observar alterações no dataset
                const observer = new MutationObserver(() => {
                    // Remover o gráfico existente antes de recriar
                    if (chartElement.children.length > 0) {
                        chartElement.innerHTML = '';
                    }
                    renderChart();
                });
            
                // Configurar o observer para observar mudanças de atributos
                observer.observe(chartElement, { attributes: true, attributeFilter: ['data-info'] });
            }
            

            // DOCUMENTS CHART
            if (document.getElementById('documents-chart')) {
                let documentsChart = document.getElementById('documents-chart');
                let chart;
            
                const renderChart = () => {
                    // Obtém os dados do atributo `data-info`
                    let documentsChartData = JSON.parse(documentsChart.dataset.info);
            
                    // Configura as opções do gráfico
                    const options = {
                        series: documentsChartData,
                        colors: ["#1A56DB", "#7E3BF2", "#e74694", "#16BDCA"],
                        chart: {
                            height: 380,
                            width: "100%",
                            type: "pie",
                        },
                        stroke: {
                            colors: ["white"],
                            lineCap: "",
                        },
                        plotOptions: {
                            pie: {
                                labels: {
                                    show: true,
                                },
                                size: "100%",
                                dataLabels: {
                                    offset: -25,
                                },
                            },
                        },
                        labels: ["Em recurso", "Invalidado", "Pendente", "Validado"],
                        dataLabels: {
                            enabled: true,
                            style: {
                                fontFamily: "Inter, sans-serif",
                            },
                        },
                        legend: {
                            position: "bottom",
                            fontFamily: "Inter, sans-serif",
                        },
                        yaxis: {
                            labels: {
                                formatter: function (value) {
                                    return value + "%";
                                },
                            },
                        },
                        xaxis: {
                            labels: {
                                formatter: function (value) {
                                    return value + "%";
                                },
                            },
                            axisTicks: {
                                show: false,
                            },
                            axisBorder: {
                                show: false,
                            },
                        },
                    };
            
                    // Destrói o gráfico existente antes de renderizar um novo
                    if (chart) {
                        chart.destroy();
                    }
            
                    // Cria e renderiza o novo gráfico
                    chart = new ApexCharts(documentsChart, options);
                    chart.render();
                };
            
                // Renderiza o gráfico inicial
                renderChart();
            
                // Observador para detectar mudanças no atributo `data-info`
                const observer = new MutationObserver(() => {
                    renderChart(); // Atualiza o gráfico quando os dados mudarem
                });
            
                // Configura o observador para monitorar mudanças no atributo `data-info`
                observer.observe(documentsChart, { attributes: true, attributeFilter: ['data-info'] });
            
                // Desconecta o observador ao descarregar a página
                window.addEventListener('beforeunload', () => observer.disconnect());
            }
            

        if (document.getElementById('documents-quantity-chart')) {
            let filesChart  = document.getElementById('documents-quantity-chart');
            let filesInfo = formatDataForChart(JSON.parse(filesChart.dataset.info));


            const options = {
                colors: ['#1A56DB', '#FDBA8C'],
                series: [
                    {
                        name: 'Quantidade',
                        color: '#1A56DB',
                        data: filesInfo
                    }
                ],
                chart: {
                    type: 'bar',
                    height: '140px',
                    fontFamily: 'Inter, sans-serif',
                    foreColor: '#4B5563',
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        columnWidth: '90%',
                        borderRadius: 3
                    }
                },
                tooltip: {
                    shared : false,
                    intersect: false,
                    style: {
                        fontSize: '14px',
                        fontFamily: 'Inter, sans-serif'
                    },
                },
                states: {
                    hover: {
                        filter: {
                            type: 'darken',
                            value: 1
                        }
                    }
                },
                stroke: {
                    show: true,
                    width: 5,
                    colors: ['transparent']
                },
                grid: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                },
                legend: {
                    show: false
                },
                xaxis: {
                    floating: false,
                    labels: {
                        show: false
                    },
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                },
                yaxis: {
                    show: false
                },
                fill: {
                    opacity: 1
                }
            };
        
            const chart = new ApexCharts(document.getElementById('documents-quantity-chart'), options);
            chart.render();
        }
  
                
        function getCurrentMonthDays() {
            const now = new Date();
            const month = now.toLocaleString('default', { month: 'short' }); // Exemplo: "Feb"
            const year = now.getFullYear();
            
            // Número de dias no mês atual
            const daysInMonth = new Date(year, now.getMonth() + 1, 0).getDate();
            
            // Gerar array com as datas
            const dates = [];
            for (let day = 1; day <= daysInMonth; day++) {
                // Formatar com zero à esquerda
                const formattedDay = day < 10 ? `0${day}` : day;
                dates.push(`${formattedDay} ${month}`);
            }
            
            return dates;
        }

        function formatDataForChart(data) {
            const formattedData = [];
        
            for (const [dateString, count] of Object.entries(data)) {
                // Cria um objeto Date a partir da string
                const date = new Date(dateString + 'T00:00:00'); // Adiciona o horário para evitar problemas de fuso
        
                // Formata a data como 'DD MMM'
                const day = date.getDate().toString().padStart(2, '0');
                const month = date.toLocaleString('default', { month: 'short' }).toUpperCase(); // Ex: NOV
        
                formattedData.push({ x: `${day} ${month}`, y: count });
            }
        
            return formattedData;
        }