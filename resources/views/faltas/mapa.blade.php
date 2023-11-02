<x-app-layout>
    <div id='calendar'></div>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>
    <!--
    <script>

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        customButtons: {
            prevYear: {
                text: 'Ano Anterior',
                click: function() {
                    calendar.prevYear();
                }
            },
            nextYear: {
                text: 'Próximo Ano',
                click: function() {
                    calendar.nextYear();
                }
            },
            scrollMonthBack: {
                text: 'Mês Anterior',
                click: function() {
                    calendar.prev();
                }
            },
            scrollMonthForward: {
                text: 'Próximo Mês',
                click: function() {
                    calendar.next();
                }
            },
            selectDate: {
                text: 'Selecionar Data',
                click: function() {
                    var selectedDate = prompt('Digite a data (AAAA-MM-DD):');
                    if (selectedDate) {
                        calendar.gotoDate(selectedDate);
                    }
                }
            }
        },
        headerToolbar: {
            start: 'prevYear scrollMonthBack',
            center: 'title',
            end: 'nextYear scrollMonthForward selectDate'
        },
        events: {!! $solicitacoes !!}, // Endpoint para obter eventos
        });
            calendar.render();
        });

    </script>
    -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        views: {
            customListView: {
                type: 'list',
                buttonText: 'Lista',
                duration: { days: 7 }, // Defina a duração da lista
            }
        },
        initialView: 'customListView',
        events: {!! $solicitacoes !!}, // Endpoint para obter eventos
        eventContent: function(arg) {
            // Personalize o conteúdo do evento na visualização da lista
            var eventoHtml = '<b>' + arg.event.title + '</b>';
            var funcionarioNome = 'Nome do Funcionário'; // Substitua pelo nome real do funcionário
            return eventoHtml + '<br>Funcionário: ' + funcionarioNome;
        }
    });

    calendar.render();
});

    </script>
</x-app-layout>