#Task 1: Create SQlite database called census-income in R and a table named Income
#defined with the appropriate column (attribute) names and data types as provided
#in the Appendix of this document.

#include the RSQLite library to access necessary commands
library("RSQLite", lib.loc="~/R/win-library/3.5")

#establishes connection to the database 'census-income'
db <- dbConnect(SQLite(), "census-income")

#create a table 'Income' and assign necessary fields and datatypes
dbSendQuery(db, "CREATE TABLE Income
            (AAGE INT,
            ACLSWKR  TEXT,
            ADTIND   TEXT,
            ADTOCC   TEXT,
            AHGA     TEXT,
            AHRSPAY  NUM,
            AHSCOL   TEXT,
            AMARITL  TEXT,
            AMJIND   TEXT,
            AMJOCC   TEXT,
            ARACE    TEXT,
            AREORGN  TEXT,
            ASEX     TEXT,
            AUNMEM   TEXT,
            AUNTYPE  TEXT,
            AWKSTAT  TEXT,
            CAPGAIN  NUM,
            CAPLOSS  NUM,
            DIVVAL   NUM,
            FILESTAT TEXT,
            GRINREG  TEXT,
            GRINST   TEXT,
            HDFMX    TEXT,
            HHDREL   TEXT,
            MARSUPWT NUM,
            MIGMTR1  TEXT,
            MIGMTR3  TEXT,
            MIGMTR4  TEXT,
            MIGSAME  TEXT,
            MIGSUN   TEXT,
            NOEMP    NUM,
            PARENT   TEXT,
            PEFNTVTY TEXT,
            PEMNTVTY TEXT,
            PENATVTY TEXT,
            PRCITSHP TEXT,
            SEOTR    TEXT,
            VETQVA   TEXT,
            VETYN    TEXT,
            WKSWORK  NUM,
            YEAR     TEXT,
            TRGT     TEXT)")

#insert the data from 'census-income.data' into the table 'Income'
dbWriteTable(db, "Income", "census-income.data", row.names = FALSE, header = FALSE, append = TRUE, sep = ", ")

#Task 2: Add a column with the name SS_ID to the 'Income' table.
#Fill this column with consecutive numbers starting from 1 for the first row.
#Make the SS_ID attribute the primary key of the 'Income' table.

#add a column 'SS_ID' to the table
dbSendQuery(db, "ALTER TABLE Income ADD SS_ID INT")

#set the value of 'SS_ID' as the value of '_rowid' as unique value
dbSendQuery(db, "UPDATE Income SET SS_ID = _rowid_")

#change the name of 'Income' to 'Income2'
dbSendQuery(db, "ALTER TABLE Income RENAME TO Income2")

#create a table called 'Income' with necessary data fields and 'SS_ID' as primary key
dbSendQuery(db, "CREATE TABLE Income
            (AAGE INT,
            ACLSWKR  TEXT,
            ADTIND   TEXT,
            ADTOCC   TEXT,
            AHGA     TEXT,
            AHRSPAY  NUM,
            AHSCOL   TEXT,
            AMARITL  TEXT,
            AMJIND   TEXT,
            AMJOCC   TEXT,
            ARACE    TEXT,
            AREORGN  TEXT,
            ASEX     TEXT,
            AUNMEM   TEXT,
            AUNTYPE  TEXT,
            AWKSTAT  TEXT,
            CAPGAIN  NUM,
            CAPLOSS  NUM,
            DIVVAL   NUM,
            FILESTAT TEXT,
            GRINREG  TEXT,
            GRINST   TEXT,
            HDFMX    TEXT,
            HHDREL   TEXT,
            MARSUPWT NUM,
            MIGMTR1  TEXT,
            MIGMTR3  TEXT,
            MIGMTR4  TEXT,
            MIGSAME  TEXT,
            MIGSUN   TEXT,
            NOEMP    NUM,
            PARENT   TEXT,
            PEFNTVTY TEXT,
            PEMNTVTY TEXT,
            PENATVTY TEXT,
            PRCITSHP TEXT,
            SEOTR    TEXT,
            VETQVA   TEXT,
            VETYN    TEXT,
            WKSWORK  NUM,
            YEAR     TEXT,
            TRGT     TEXT,
            SS_ID   INTEGER CONSTRAINT pk PRIMARY KEY)")

#copy data from 'Income2' into 'Income'
dbSendQuery(db, "INSERT INTO Income SELECT * FROM Income2")

#read Income table into dataframe
Income <- dbReadTable(db, "Income")

#Task 3: Construct SQL queries that provide the total number of
#males and females for each race group reported in the data.
#The result should show for example how many
#white females, white males, black males etc. are included into the dataset.

#count all females grouped by race
query <- dbSendQuery(db, "SELECT DISTINCT ARACE, count(*) AS 'Female' FROM Income WHERE ASEX = 'Female' GROUP BY ARACE")
females <- dbFetch(query, n = -1)

#count all males grouped by race
query <- dbSendQuery(db, "SELECT DISTINCT ARACE, count(*) AS 'Male' FROM Income WHERE ASEX = 'Male' GROUP BY ARACE")
males <- dbFetch(query, n = -1)

#merge females and males grouped by race
result <- merge(females, males)

#create new dataframe showing only counts of females and males
genxrac <- result[,-1]

#set the rownames of 'genxrac' as race groups
rownames(genxrac) <- result[,1]

#Task 4: Write queries to calculate the average annual income
#(income = weeks worked per year * age per hour, assuming 40 hours of work per week)
#of the reported individuals for each race groups, considering only those with non-zero wage per hour.

#creates a dataframe of distinct races
query <- dbSendQuery(db, "SELECT DISTINCT ARACE FROM Income")
races <- dbFetch(query, n = -1)

#creates a blank dataframe called 'avg'
avg <- data.frame(Race = NA, Average_Income = NA)

#for loop, loops through races datafrane
for(i in 1:nrow(races)) {
  
  #sets the variable 'race' to the row from the races dataframe
  race <- races[i,1]
  
  #query the Income table to get the sum and then average of the income of each race group
  query <- dbSendQuery(db, paste("SELECT ARACE, (AVG(AHRSPAY * WKSWORK)) AS AVERAGE FROM Income
                                 WHERE AHRSPAY != 0 AND ARACE = '", race, "'", sep = ""))
  result <- dbFetch(query, n = -1)
  
  #inset the race and average income into the avg dataframe
  avg[i,1] <- result[1,1]
  avg[i,2] <- result[1,2]
}

#Task 5: Create 3 other tables named: Person, Job and Pay, 
#by extracting the following fieldsrespectively from the Income table.
#Write queries that extract the appropriate values from corresponding attributes
#in the initial Income table and insert them into the newly created tables

#drop tables if they exisy
dbSendQuery(db, "DROP TABLE  IF EXISTS Person")
dbSendQuery(db, "DROP TABLE IF EXISTS Job")
dbSendQuery(db, "DROP TABLE IF EXISTS Pay")

#create a new table called 'Person'
query <- dbSendQuery(db, "CREATE TABLE Person
                     (Id       INT PRIMARY KEY,
                     AAGE      INT,
                     AHGA      TEXT,
                     ASEX      TEXT,
                     PRCITSHP  TEXT,
                     PARENT    TEXT,
                     GRINST    TEXT,
                     GRINREG   TEXT,
                     AREORGN   TEXT,
                     AWKSTAT   TEXT,
                     FOREIGN KEY (Id, AAGE, AHGA, ASEX, PRCITSHP, PARENT, GRINST, GRINREG, AREORGN, AWKSTAT)
                     References Income (SS_ID, AAGE, AHGA, ASEX, PRCITSHP, PARENT, GRINST, GRINREG, AREORGN, AWKSTAT))")

#insert the data from the Income table
dbSendQuery(db, "INSERT INTO Person SELECT SS_ID, AAGE, AHGA, ASEX, PRCITSHP, PARENT, GRINST, GRINREG, AREORGN, AWKSTAT FROM Income")

#read data from Person into dataframe
Person <- dbReadTable(db, "Person")

#create a new table called 'Job'
query <- dbSendQuery(db, "CREATE TABLE Job
                     (occjd    INT PRIMARY KEY,
                     ADTIND    TEXT,
                     ADTOCC    TEXT,
                     AMJOCC    TEXT,
                     AMJIND    TEXT,
                     FOREIGN KEY (occjd, ADTIND, ADTOCC, AMJOCC, AMJIND)
                     References Income (SS_ID, ADTIND, ADTOCC, AMJOCC, AMJIND))")

#insert the data from the Income table
dbSendQuery(db, "INSERT INTO Job SELECT SS_ID, ADTIND, ADTOCC, AMJOCC, AMJIND FROM Income")

#read data from Job into dataframe
Job <- dbReadTable(db, "Job")

#create a new table called 'Pay'
query <- dbSendQuery(db, "CREATE TABLE Pay
                     (job_id   INT PRIMARY KEY,
                     AHRSPAY   NUM,
                     WKSWORK   NUM,
                     FOREIGN KEY (job_id, AHRSPAY, WKSWORK)
                     References Income (SS_ID, AHRSPAY, WKSWORK))")

#insert the data from the Income table
dbSendQuery(db, "INSERT INTO Pay SELECT SS_ID, AHRSPAY, WKSWORK FROM Income")

#read data from Pay into dataframe
Pay <- dbReadTable(db, "Pay")

#Task 6: Use these three new tables (constructed in 5.) for the tasks below.
  #Part 1: Given the data in your tables, create an SQL statement to select the highest hourly wage,
  #the number of people residing in each state (GRINST) employed in this job,
  #the state, the job type and major industry

#select highest hourly wage, count people in job, get state, get job type, get major industry,
#join all tables together with Inner Join,
#get job type of highest hourly wage
query <- dbSendQuery(db, "SELECT MAX(Pay.AHRSPAY) AS Highest_Wage,
                     count(*) AS Number_Of_People,
                     Person.GRINST AS State,
                     Job.AMJOCC AS Job_Type,
                     Job.AMJIND AS Major_Industry
                     FROM Person
                     INNER JOIN Pay on Pay.job_id = Person.Id
                     INNER JOIN Job on Job.occjd = Person.Id
                     WHERE Job.AMJOCC = (SELECT Job.AMJOCC FROM Job
                     INNER JOIN Pay on Pay.job_id = Job.occjd
                     WHERE Pay.AHRSPAY = (SELECT max(Pay.AHRSPAY) FROM Pay))
                     GROUP BY GRINST")

#creare new dataframe with results of query
Highest_Wage_By_State <- dbFetch(query, n = -1)

  #Part 2: Write an SQL query to determine the employment of people of Hispanic origin with
  #BSc (Bachelors degree), MSc (Masters degree), and PhD (Doctorate degree)
  #showing the type of industry they are employed in,
  #their average hourly wage and average number of weeks worked per year for each industry.

#select major industry, average hourly pay and average weeks worked,
#join all tables together with Inner Join,
#remove non-hisapnic records and select relevant education,
#group results by state
query <- dbSendQuery(db, "SELECT Job.AMJIND AS Major_Industry,
                     ROUND(AVG(Pay.AHRSPAY), 2) AS Average_Pay,
                     ROUND(AVG(pay.WKSWORK), 0) AS Average_Weeks_Worked
                     FROM Job
                     INNER JOIN Person on Person.Id = Job.occjd
                     INNER JOIN Pay on Pay.job_id = Job.occjd
                     WHERE Person.AREORGN NOT IN ('All other', 'Do not know', 'NA')
                     AND Person.AHGA IN ('Bachelors degree(BA AB BS)', 'Masters degree(MA MS MEng MEd MSW MBA)', 'Doctorate degree(PhD EdD)')
                     GROUP BY Job.AMJIND")

#creare new dataframe with results of query
Industry <- dbFetch(query, n = -1)