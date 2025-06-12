import React, { useState } from 'react';
import FullCalendar from '@fullcalendar/react';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';

const Appointments = () => {
  const [events] = useState([
    {
      id: '1',
      title: 'Max - Checkup',
      start: '2024-03-20T10:00:00',
      end: '2024-03-20T11:00:00',
      backgroundColor: '#4F46E5',
    },
    {
      id: '2',
      title: 'Luna - Vaccination',
      start: '2024-03-20T14:00:00',
      end: '2024-03-20T15:00:00',
      backgroundColor: '#059669',
    },
  ]);

  const handleDateSelect = (selectInfo) => {
    const title = prompt('Please enter a title for your appointment');
    if (title) {
      const calendarApi = selectInfo.view.calendar;
      calendarApi.unselect();
      calendarApi.addEvent({
        id: String(new Date().getTime()),
        title,
        start: selectInfo.startStr,
        end: selectInfo.endStr,
        allDay: selectInfo.allDay,
      });
    }
  };

  return (
    <div className="space-y-6">
      <div className="sm:flex sm:items-center sm:justify-between">
        <div>
          <h2 className="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
            Appointments
          </h2>
        </div>
        <div className="mt-4 sm:mt-0 sm:ml-4">
          <button
            type="button"
            className="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
          >
            Add Appointment
          </button>
        </div>
      </div>

      <div className="bg-white shadow rounded-lg">
        <div className="px-4 py-5 sm:p-6">
          <FullCalendar
            plugins={[dayGridPlugin, timeGridPlugin, interactionPlugin]}
            headerToolbar={{
              left: 'prev,next today',
              center: 'title',
              right: 'dayGridMonth,timeGridWeek,timeGridDay',
            }}
            initialView="dayGridMonth"
            editable={true}
            selectable={true}
            selectMirror={true}
            dayMaxEvents={true}
            weekends={true}
            events={events}
            select={handleDateSelect}
            eventClick={(info) => {
              if (
                confirm(
                  `Are you sure you want to delete the appointment '${info.event.title}'`
                )
              ) {
                info.event.remove();
              }
            }}
          />
        </div>
      </div>
    </div>
  );
};

export default Appointments; 