# **JavaServer Pages (JSP) Notes**

### 1. **Introduction to JSP**
- **Definition**: JSP is a server-side technology that helps in creating dynamic web pages. It allows embedding Java code in HTML.
- **Purpose**: Extends the capabilities of servlets by simplifying the development of dynamic web content.
- **File Extension**: `.jsp`
  
### 2. **JSP Life Cycle**
- **Phases**:
  1. **Translation Phase**: JSP gets translated into a servlet.
  2. **Compilation Phase**: The servlet is compiled into bytecode.
  3. **Initialization Phase**: `jspInit()` method is called.
  4. **Request Handling**: `jspService()` method is called for every request.
  5. **Destruction Phase**: `jspDestroy()` is called before the JSP is unloaded from memory.

- **Methods**:
  - `jspInit()`: Called once during JSP initialization.
  - `jspService()`: Handles requests, called multiple times.
  - `jspDestroy()`: Called once before the JSP is destroyed.
    
### 3. **JSP Run**
  - Install JDK, & Xmpp Server Watch video for configuration <a href="https://youtu.be/i7jJ7aN30fM?si=UwlDNir9S1yN-ee3"> click here</a>
  - Basic Project Strucutre
  ```
    MyFirstJSP/
    ├── WEB-INF/
    │   ├── web.xml
    │   └── lib/         (optional: contains libraries like JAR files)
    ├── META-INF/        (optional: contains metadata about the application)
    ├── index.jsp        (main JSP file)
    ├── css/             (optional: contains CSS files for styling)
    ├── js/              (optional: contains JavaScript files)
    └── images/          (optional: contains image files)
  ```
```
//web.xml
<?xml version="1.0" encoding="UTF-8"?>
<web-app xmlns="http://java.sun.com/xml/ns/javaee" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:schemaLocation="http://java.sun.com/xml/ns/javaee
         http://java.sun.com/xml/ns/javaee/web-app_2_5.xsd" version="2.5">
    <display-name>MyFirstJSP2</display-name> <!-- In this case, it's called MyFirstJSP, and this name can appear in server administration panels or logs. -->
    <!-- set default file serve by root instead of index.jsp file -->
    <welcome-file-list>
        <welcome-file>about.jsp</welcome-file>
    </welcome-file-list>
</web-app>
```  

---

### 3. **JSP Syntax Elements**
- **Directives**: Provide global information about the JSP page.
  - **Syntax**: `<%@ directive attribute="value" %>`
  - **Types**:
    - **Page Directive**: `<%@ page ... %>` (defines attributes like `import`, `session`, `language`, etc.)
    - **Include Directive**: `<%@ include file="file.jsp" %>` (static inclusion of other resources)
    - **Taglib Directive**: `<%@ taglib uri="..." prefix="..." %>` (used for custom tags)
  
- **Scriptlets**: Embeds Java code in JSP.
  - **Syntax**: `<% Java code %>`
  - Example: `<% int x = 5; %>`

- **Declarations**: Define variables and methods used in JSP.
  - **Syntax**: `<%! Java declaration %>`
  - Example: `<%! int counter = 0; %>`

- **Expressions**: Outputs the value of Java expressions directly in the output stream.
  - **Syntax**: `<%= expression %>`
  - Example: `<%= 2 + 2 %>`

- **Comments**:
  - **JSP Comment**: `<%-- Comment --%>` (not visible in HTML source)
  - **HTML Comment**: `<!-- Comment -->` (visible in HTML source)

---

### 4. **JSP Implicit Objects**
JSP provides 9 implicit objects that developers can use without declaring them.
- **Request**: `HttpServletRequest` object.
- **Response**: `HttpServletResponse` object.
- **Session**: `HttpSession` object.
- **Application**: ServletContext object.
- **Out**: `JspWriter` object used to send output to the client.
- **Config**: ServletConfig object for initialization parameters.
- **PageContext**: Provides access to page-level objects.
- **Exception**: Used for error pages, represents the Throwable object.
- **Page**: Refers to the instance of the generated servlet.

---

### 5. **JSP Action Elements**
- **UseBean**: Used for creating or locating a bean.
  - Syntax: `<jsp:useBean id="beanId" class="beanClass" scope="scopeType"/>`
- **GetProperty**: Retrieves the value of a bean property.
  - Syntax: `<jsp:getProperty name="beanName" property="propertyName"/>`
- **SetProperty**: Sets the value of a bean property.
  - Syntax: `<jsp:setProperty name="beanName" property="propertyName" value="value"/>`
- **Include**: Dynamically includes another resource (servlet, HTML, JSP).
  - Syntax: `<jsp:include page="resource.jsp" />`
- **Forward**: Forwards the request to another resource.
  - Syntax: `<jsp:forward page="other.jsp"/>`
- **Plugin**: Used to embed Java applets or JavaBeans components.
  - Syntax: `<jsp:plugin type="applet/bean" .../>`

---

### 6. **JSP Scopes**
Defines the visibility of attributes within a JSP page:
- **Page Scope**: Available only on the current JSP page (default).
- **Request Scope**: Available throughout the request.
- **Session Scope**: Available across the entire session.
- **Application Scope**: Available to all components of the web application.

---

### 7. **JSP Error Handling**
- Use **isErrorPage** attribute to create a JSP error page.
- Use **errorPage** attribute in a regular JSP to redirect to the error page in case of an exception.
- Example:
  - Regular JSP: `<%@ page errorPage="error.jsp" %>`
  - Error JSP: `<%@ page isErrorPage="true" %>`

---

### 8. **JSP Expression Language (EL)**
Simplifies access to data stored in JavaBeans, arrays, collections, and implicit objects.
- **Syntax**: `${expression}`
- Example: `${user.name}` accesses the `name` property of the `user` bean.
- Operators: **Arithmetic**, **Relational**, **Logical**, **Empty** (checks if a value is null or empty).
  
---

### 9. **JSP Custom Tags**
Allows creating reusable components in JSP using tag libraries (TagLibs).
- **Tag Handler Classes**: Define custom tag behavior.
- **JSP Tag Libraries**: Reuse tags across multiple JSP pages.
- **TLD File**: Tag Library Descriptor (XML file that defines the tags).

---

### 10. **JSP Standard Tag Library (JSTL)**
A tag library that encapsulates common JSP functionalities. Common JSTL tags:
- **Core Tags**: `<c:if>`, `<c:forEach>`, `<c:set>`, `<c:choose>`, `<c:out>`, etc.
- **Formatting Tags**: `<fmt:formatDate>`, `<fmt:formatNumber>`, etc.
- **SQL Tags**: `<sql:query>`, `<sql:update>`, etc.
- **XML Tags**: `<x:parse>`, `<x:out>`, etc.

---

### 11. **Session Management in JSP**
- **HttpSession** object allows maintaining session data across requests.
- Methods:
  - `session.setAttribute()`: Stores an attribute in the session.
  - `session.getAttribute()`: Retrieves the stored attribute.
  - `session.invalidate()`: Destroys the session.

---

### 12. **JSP with JDBC**
Integrate JSP with JDBC to interact with databases.
- Establish a connection with the database.
- Execute SQL queries using `Statement` or `PreparedStatement`.
- Retrieve data using `ResultSet`.
  
---

### 13. **JSP with MVC Architecture**
- **Model**: Business logic layer (JavaBeans, POJOs).
- **View**: Presentation layer (JSP).
- **Controller**: Handles requests (Servlets).
  
---

### 14. **JSP Security**
- Use SSL for encrypted communication.
- Implement authentication (Basic, Form-based, or Custom).
- Use filters for input validation and access control.

---

### 15. **JSP Best Practices**
- Separate Java logic from JSP using Servlets or JavaBeans.
- Avoid using scriptlets, use EL and JSTL for better readability.
- Apply MVC architecture for better organization and maintainability.
- Handle exceptions gracefully with error pages.
- Use custom tags and tag libraries for reusable components.

---

### 16. **Additional JSP Features**
- **File Uploads**: Handle file uploads using libraries like Apache Commons FileUpload.
- **Filters**: Preprocessing and postprocessing of requests and responses.
- **Cookies**: Manage user data between requests using `cookie` objects.
- **Internationalization (i18n)**: Use JSTL `fmt` tag library for locale-sensitive data formatting.

---

### Conclusion
JavaServer Pages (JSP) is a powerful technology for developing dynamic, server-side web applications. With its rich set of features, such as JSP directives, EL, JSTL, and MVC integration, it is widely used in enterprise-level applications. Focus on keeping JSP pages clean by minimizing Java code and following best practices for maintainability and scalability.

---

This should give you a solid understanding of JSP. You can add more detailed code examples and advanced topics based on your learning needs.
