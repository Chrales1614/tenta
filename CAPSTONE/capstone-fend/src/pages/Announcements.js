  <div className="mt-6 flow-root">
    <ul className="-my-5 divide-y divide-gray-200">
      {announcements.map((announcement) => (
        <li key={announcement.id} className="py-5">
          <div className="relative focus-within:ring-2 focus-within:ring-indigo-500">
            <h3 className="text-sm font-semibold text-gray-800">
              <span className="absolute inset-0" aria-hidden="true" />
              {announcement.title}
            </h3>
            <p className="mt-1 text-sm text-gray-600 line-clamp-2">
              {announcement.content}
            </p>
          </div>
          <div className="mt-2 flex items-center gap-x-4 text-xs">
            <div className="flex items-center gap-x-1">
              <span
                className={`inline-flex items-center rounded-full px-2 py-1 text-xs font-medium ${
                  announcement.isActive
                    ? 'bg-green-50 text-green-700 ring-1 ring-inset ring-green-600/20'
                    : 'bg-gray-50 text-gray-600 ring-1 ring-inset ring-gray-500/10'
                }`}
              >
                {announcement.isActive ? 'Active' : 'Inactive'}
              </span>
            </div>
            <div className="text-gray-500">
              Posted by {announcement.createdBy} on{' '}
              {new Date(announcement.createdAt).toLocaleDateString()}
            </div>
          </div>
        </li>
      ))}
    </ul>
  </div> 