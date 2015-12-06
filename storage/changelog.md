# Change Log

## Future Plans
- Possibility to remove entries from the gathered results
- Move time consuming jobs to threads
- Loading progress bars
- Use LinkedIn API instead of website crawler

## [0.3.7] - 2015-12-10
### Fixed
- Added simple/detailed report downloads

## [0.3.6] - 2015-11-27
### Fixed
- Logic of LinkedIn and Xing Importer handling the dom elements

### Changed
- Replaced Xing Crawler with Xing API
- Refactored Information Gathering for Xing
- Adapted threat report and gathered results according to new findings from API

## [0.3.5] - 2015-11-20
### Changed
- Replaced Google Maps Script
- Profiles in Report are sorted by Name

### Fixed
- LinkedIn Importer adapted to website changes from LinkedIn
- PDF-Report is now possible without findings 

### Added
- Map added to the PDF report
- Maltego Importer
- Characteristics Formulas for Threat Values Calculation
- Threat Level Calculation
- User can enter additional information on the Dashboard depending on selected attacktype
- Commented all methods for easier readability
- Findings from dashboard form are displayed in pdf report
- Findings from dashboard form are displayed on threat assessment page

## [0.3.4] - 2015-11-06
### Added
- Google Maps displays all found locations
- Threat Values Calculation for Characteristics
- Mapping between attack types and characteristics
- Import of files over dashboard

## [0.3.3] - 2015-10-30
### Fixed
- CURL Requests

### Added
- Merger for findings
- Tablesort for listing of findings
- XingCrawler for companies and profiles
- Retrieval of Communication Channels from Xing
- Coordinates to Name Converter
- Cree.py Importer

### Removed
- Database Models and Configurations not needed anymore (Replaced by temporary saving in session)

## [0.2.2] - 2015-10-21
### Fixed
- ReconNG Importer

### Added
- Tooltips on dashboard
- Attack types are selectable on dashboard
- Database Models
- Database Configuration

## [0.1.1] - 2015-10-14
### Added
- Project Setup
- Dependencies
- Views and Controller Actions with dummy content
- Navigation Elements
- Tips on how to use recon-ng and theHarvester on help page 
