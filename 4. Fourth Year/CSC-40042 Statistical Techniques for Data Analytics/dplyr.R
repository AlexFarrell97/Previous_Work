#Task 7.1: Create SQlite database called census-income in R and a table named Income
#defined with the appropriate column (attribute) names and data types as provided
#in the Appendix of this document.
#Note: dplyr doesn't require a database, therefore data file loaded into dataframe

#install and initialise 'dplyr' package
install.packages("dplyr")
library("dplyr", lib.loc="~/R/win-library/3.5")

#read the data in the 'census-income.data' file into a dataframe
census_income <- read.csv("census-income.data", header = FALSE)

#set the column names of the dataframe
colnames(census_income) <- c("AAGE",
                             "ACLSWKR",
                             "ADTIND",
                             "ADTOCC",
                             "AHGA",
                             "AHRSPAY",
                             "AHSCOL",
                             "AMARITL",
                             "AMJIND",
                             "AMJOCC",
                             "ARACE",
                             "AREORGN",
                             "ASEX",
                             "AUNMEM",
                             "AUNTYPE",
                             "AWKSTAT",
                             "CAPGAIN",
                             "CAPLOSS",
                             "DIVVAL",
                             "FILESTAT",
                             "GRINREG",
                             "GRINST",
                             "HDFMX",
                             "HHDREL",
                             "MARSUPWT",
                             "MIGMTR1",
                             "MIGMTR3",
                             "MIGMTR4",
                             "MIGSAME",
                             "MIGSUN",
                             "NOEMP",
                             "PARENT",
                             "PEFNTVTY",
                             "PEMNTVTY",
                             "PENATVTY",
                             "PRCITSHP",
                             "SEOTR",
                             "VETQVA",
                             "VETYN",
                             "WKSWORK",
                             "YEAR",
                             "TRGT")

#Task 7.2: Add a column with the name SS_ID to the 'Income' table.
#Fill this column with consecutive numbers starting from 1 for the first row.
#Make the SS_ID attribute the primary key of the 'Income' table.

#add new coumn 'SS_ID' and set it to the rowname
#(in this case, number as no rowname has been assigned)
census_income <- mutate(census_income, SS_ID = rownames(census_income))

#Task 7.3: Construct SQL queries that provide the total number of
#males and females for each race group reported in the data.
#The result should show for example how many
#white females, white males, black males etc. are included into the dataset.

#group data from 'census_income' and calculate the number of males and females per race
genxrac <- group_by(census_income, ASEX, ARACE) %>% tally()

#Task 7.4: Write queries to calculate the average annual income
#(income = weeks worked per year * age per hour, assuming 40 hours of work per week)
#of the reported individuals for each race groups, considering only those with non-zero wage per hour.

#filter out the records with 0 AHRSPAY
Average_Income <- filter(census_income, AHRSPAY != 0) %>%
  #group results by ARACE
  group_by(ARACE) %>%
  #calculate the average
  summarise(Average_Income = mean(AHRSPAY*WKSWORK))

#Task 7.5: Create 3 other tables named: Person, Job and Pay, 
#by extracting the following fieldsrespectively from the Income table.
#Write queries that extract the appropriate values from corresponding attributes
#in the initial Income table and insert them into the newly created tables

#extract data from 'census_income' and put it in a new dataframe
Person <- select(census_income, SS_ID,
                 AAGE,
                 AHGA,
                 ASEX,
                 PRCITSHP,
                 PARENT,
                 GRINST,
                 GRINREG,
                 AREORGN,
                 AWKSTAT)

#extract data from 'census_income' and put it in a new dataframe
Job <- select(census_income, SS_ID,
              ADTIND,
              ADTOCC,
              AMJOCC,
              AMJIND)

#extract data from 'census_income' and put it in a new dataframe
Pay <- select(census_income, SS_ID,
              AHRSPAY,
              WKSWORK)

#Task 7.6: Use these three new tables (constructed in 5.) for the tasks below.
  #Part 1: Given the data in your tables, create an SQL statement to select the highest hourly wage,
  #the number of people residing in each state (GRINST) employed in this job,
  #the state, the job type and major industry

#get id of highest wage job
Pay_ID <- select(Pay, SS_ID, AHRSPAY) %>% filter(AHRSPAY == max(AHRSPAY)) %>% select(SS_ID)

#get job title of highest wage job
Job_Highest_Wage <- Job %>% select(SS_ID, AMJOCC) %>% filter(SS_ID == Pay_ID$SS_ID) %>% select(AMJOCC)

#join all tables together
Highest_Wage_By_State <- inner_join(Person, Job, by = c("SS_ID" = "SS_ID")) %>%
  inner_join(., Pay, by = c("SS_ID" = "SS_ID")) %>%
  #select required fields
  select(SS_ID, AHRSPAY, GRINST, AMJOCC, AMJIND) %>%
  #filter results to only show those with the same job type as 'Job_Highest_Wage' variable
  filter(AMJOCC == Job_Highest_Wage$AMJOCC) %>%
  #group results by state
  group_by(`State` = `GRINST`) %>%
  #summarise results to get max pay and number of people
  summarise(`Highest_ Wage` = max(`AHRSPAY`),`Number_Of_People` = n(), `Job_Type` = first(`AMJOCC`), `Major_Industry` = first(`AMJIND`))

  #Part 2: Write an SQL query to determine the employment of people of Hispanic origin with
  #BSc (Bachelors degree), MSc (Masters degree), and PhD (Doctorate degree)
  #showing the type of industry they are employed in,
  #their average hourly wage and average number of weeks worked per year for each industry.

#select fields from person
Industry <- select(Person, SS_ID, AHGA, AREORGN) %>%
  
  #join tables together
  inner_join(Job, by = "SS_ID") %>%
  inner_join(Pay, by = "SS_ID") %>%
  
  #show only those of hispanic origin
  filter(AREORGN != ' All other' & AREORGN != ' Do not know' & AREORGN != ' NA') %>%
  
  #show only those with a degree
  filter(AHGA == ' Bachelors degree(BA AB BS)' | AHGA == ' Masters degree(MA MS MEng MEd MSW MBA)' | AHGA == ' Doctorate degree(PhD EdD)') %>%
  
  #group by major industry
  group_by(AMJIND) %>%
  
  #calcluate average hourly wage and average weeks worked
  summarise(`Average Wage` = round(mean(`AHRSPAY`), 2), `Average Weeks Worked` = round(mean(`WKSWORK`), 0))