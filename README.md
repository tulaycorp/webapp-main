# E-Shop - Modern E-commerce Web Application

A clean, modern e-commerce web application built with Node.js, Express, and Bootstrap. Features a responsive design, dark/light theme toggle, shopping cart functionality, and a RESTful API.

## Features

- **Modern UI**: Clean, responsive design with Bootstrap 5
- **Dark/Light Theme**: Automatic theme detection with manual toggle
- **Shopping Cart**: Add, remove, and manage items with persistent storage
- **Product Catalog**: Browse, search, and filter products by category
- **Contact Form**: Functional contact form with server-side handling
- **RESTful API**: Complete API for products, users, and cart management
- **Server-Side Rendering**: Express.js server with static file serving

## Project Structure

```
webapp-main/
├── public/                 # Static files served by Express
│   ├── css/               # Stylesheets
│   │   └── styles.css     # Custom CSS
│   ├── js/                # Client-side JavaScript
│   │   └── app.js         # Main application logic
│   ├── index.html         # Homepage
│   ├── products.html      # Products catalog
│   ├── cart.html          # Shopping cart
│   ├── about.html         # About page
│   └── contact.html       # Contact page
├── server.js              # Express server
├── package.json           # Dependencies and scripts
├── users.json             # User data storage (created automatically)
└── README.md              # This file
```

## Installation

1. **Clone or download the project**
2. **Install dependencies:**
   ```bash
   npm install
   ```
3. **Start the development server:**
   ```bash
   npm run dev
   ```
   Or for production:
   ```bash
   npm start
   ```

4. **Open your browser to:**
   ```
   http://localhost:3000
   ```

## Available Scripts

- `npm start` - Start the production server
- `npm run dev` - Start development server with auto-restart (requires nodemon)
- `npm run build` - Build CSS assets
- `npm run setup` - Install dependencies and build assets

## API Endpoints

### Products
- `GET /api/products` - Get all products (supports filtering and sorting)
- `GET /api/products/:id` - Get single product
- `GET /api/categories` - Get all product categories

### Authentication
- `POST /api/auth/register` - Register new user
- `POST /api/auth/login` - User login

### Contact
- `POST /api/contact` - Submit contact form

## Features in Detail

### Shopping Cart
- Persistent cart storage using localStorage
- Add/remove items with quantity management
- Real-time total calculation with tax
- Responsive cart display

### Product Catalog
- Search functionality
- Category filtering
- Multiple sorting options (featured, alphabetical, price)
- Responsive grid layout

### Theme System
- Automatic dark/light mode detection
- Manual theme toggle
- Persistent theme preference
- Bootstrap-compatible theme variables

### Responsive Design
- Mobile-first approach
- Collapsible navigation
- Optimized layouts for all screen sizes
- Touch-friendly interfaces

## Dependencies

### Production
- **express** - Web framework for Node.js
- **cors** - Cross-origin resource sharing
- **bootstrap** - CSS framework for responsive design

### Development
- **nodemon** - Auto-restart server during development
- **postcss** & **autoprefixer** - CSS processing tools

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

## Development

### Adding New Products
Products are currently stored in the `CATALOG` array in `server.js`. To add new products:

1. Add product objects to the array with required fields:
   ```javascript
   {
     id: 'unique-id',
     name: 'Product Name',
     price: 99.99,
     category: 'Category',
     featured: true/false,
     img: 'image-url'
   }
   ```

### Customizing Styles
- Edit `public/css/styles.css` for custom styling
- Theme variables are defined in CSS custom properties
- Bootstrap classes are available throughout

### Adding New Pages
1. Create HTML file in `public/` directory
2. Add route in `server.js` if needed
3. Update navigation in all HTML files
4. Add page-specific logic to `public/js/app.js`

## Future Enhancements

- User authentication with sessions/JWT
- Database integration (MongoDB, PostgreSQL)
- Payment processing integration
- Order management system
- Admin dashboard
- Email notifications
- Product reviews and ratings
- Wishlist functionality

## License

This project is open source and available under the [MIT License](LICENSE).

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## Support

For questions or issues, please use the contact form in the application or create an issue in the repository.